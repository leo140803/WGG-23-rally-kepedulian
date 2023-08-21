<?php

namespace App\Controllers\Rally;

use App\Models\RBAC\RBACRouteModel;
use CodeIgniter\I18n\Time;
use App\Models\Rally\ItemModel;
use App\Models\Rally\ItemImgModel;
use App\Controllers\BaseController;
use App\Models\LogPointModel;
use App\Models\Rally\KelompokModel;
use App\Models\Rally\PembelianModel;
use App\Models\Rally\KelompokRallyModel;

class Rally extends BaseController
{
    protected $kelompokRally;
    protected $kelompok;
    protected $item;
    protected $pembelian;
    protected $itemImg;
    protected $logPoint;
    protected $db;

    public function __construct()
    {
        $this->kelompokRally = new KelompokRallyModel();
        $this->kelompok = new KelompokModel();
        $this->item = new ItemModel();
        $this->pembelian = new PembelianModel();
        $this->itemImg = new ItemImgModel();
        $this->logPoint = new LogPointModel();
        $this->db = \Config\Database::connect();
    }

    /**
     * Halaman utama mahasiswa
     * 
     * @return CodeIgniter\HTTP\Message
     */
    public function index()
    {
        // session()->set('kelompok', $this->kelompokRally->find(1));

        if (!session()->get('kelompok'))
            return redirect()->to(site_url('games'));

        $tmp = $this->pembelian->get_records();
        $records = [];
        foreach ($tmp as $t)
            $records[] = $t['id_item'];

        $data = [
            'display' => $this->item->get_display_item($records),
            'coin' => $this->kelompokRally->get_poin(session()->get('kelompok')['id']),
            'title' => 'Rally Games',
        ];

        // remove duplicate balok kayu
        $countKayu = count($this->pembelian->get_specific_record(31));
        if ($countKayu > 0) {
            $indexes = [];
            foreach ($data['display'] as $key => $value)
                if ($data['display'][$key]['nama'] === "Balok Kayu")
                    $indexes[] = $key;

            for ($i = $countKayu; $i < 3; $i++)
                unset($data['display'][$indexes[$i]]);
        }

        // cek ketua
        $ketua = $this->kelompok->get_ketua();
        $data['shop'] = $this->item->get_shop_item($records);
        $data['isKetua'] = session()->get('nrp') == $ketua['nrp'] ? "true" : "false";

        if ($countKayu >= 1 && $countKayu < 3 && session()->get('nrp') == $ketua['nrp'] && session()->get('kelompok')['scene'] == 3) {
            $data['shop'][] = $this->item->find(31);
        }

        if (session()->get('kelompok')['scene'] == 1) {
            return view('rally/gurun', $data);
        } else if (session()->get('kelompok')['scene'] == 2) {
            return view('rally/economic', $data);
        } else if (session()->get('kelompok')['scene'] == 3) {
            return view('rally/herdmental', $data);
        }
    }

    /**
     * Halaman admin buat update poin
     * 
     * @return CodeIgniter\HTTP\Message
     */
    public function add_point()
    {
        // $validation = session()->get('validation') ?? \Config\Services::validation();
        return view('rally/admin', [
            'kelompok' => $this->kelompok->get_info_kelompok(),
            'title' => 'Input Poin',
            // 'validation' => $validation,
        ]);
    }

    /**
     * Fungsi update poin kelompok
     * 
     * @return CodeIgniter\HTTP\Message
     */
    public function update_point()
    {
        $validasi = [
            'input-kelompok' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama kelompok harus diisi',
                ]
            ],
            'input-poin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tambahan poin harus diisi',
                    'greater_than' => 'Tambahan poin harus lebih besar dari 0',
                ]
            ],
        ];

        if (!$this->validate($validasi)) {
            $validation = \Config\Services::validation();
            // dd($validation->getErrors());
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $id_kel = $this->kelompok->get_id($this->request->getVar('input-kelompok'));
        // dd($id_kel);

        if ($id_kel[0]) {
            // start transaction
            $this->db->transStart();

            $this->kelompokRally->add_point($id_kel[0]['id'], $this->request->getVar('input-poin'));
            $this->logPoint->insert([
                'nrp' => session()->get('nrp'),
                'id_kelompok' => $id_kel[0]['id'],
                'poin' => $this->request->getVar('input-poin'),
                'created_at' => Time::now(),
                'updae_at' => Time::now(),
            ]);

            // end transaction
            $this->db->transComplete();

            // failed transaction
            if ($this->db->transStatus() === false) {
                return redirect()->back()->with('error', 'Terjadi kesalahan dalam memasukkan poin, silahkan coba lagi');
            }

            return redirect()->back()->with('success', 'Poin kelompok ' . $this->request->getVar('input-kelompok') . ' berhasil ditambahkan');
        }

        return redirect()->back()->with('error', 'Kelompok ' . $this->request->getVar('input-kelompok') . ' tidak ditemukan');
    }

    /**
     * Fungsi untuk membeli barang
     * 
     * @return array
     */
    public function buy()
    {
        $item_id = $this->request->getVar('item_id');
        $items = $this->item->get_item([$item_id]);

        $images = array();
        foreach ($items as $key => $val)
            $images[$key] = $val['image'];
        array_multisort($images, SORT_ASC, $items);

        // cek barang
        if (!$items[0] || !$items[0]['repaired'] == 1) {
            // barang invalid
            return json_encode([
                'response' => [
                    'icon' => 'error',
                    'title' => 'Gagal!',
                    'text' => 'Barang tidak ditemukan'
                ],
                'item' => null,
                'coin' => $this->kelompokRally->get_poin(session()->get('kelompok')['id_kelompok']),
                'csrf_name' => csrf_token(),
                'csrf_hash' => csrf_hash(),
            ]);
        }

        $alerts = [
            [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'Gagal membeli barang ' . $items[0]['nama'] . ', silahkan coba lagi'
            ],
            [
                'icon' => 'success',
                'title' => 'Sukses!',
                'text' => 'Berhasil membeli ' . $items[0]['nama']
            ],
            [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'Poin mu tidak cukup untuk membeli ' . $items[0]['nama']
            ],
            [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'Barang sudah dibeli!'
            ],
            [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'Hanya ketua kelompok yang dapat melakukan pembelian!'
            ],
            [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'Barang harus dibeli secara berurutan!'
            ],
        ];

        // cek ketua
        if (session()->get('nrp') != $this->kelompok->get_ketua()['nrp']) {
            return json_encode([
                'response' => $alerts[4],
                'item' => null,
                'coin' => $this->kelompokRally->get_poin(session()->get('kelompok')['id_kelompok']),
                'csrf_name' => csrf_token(),
                'csrf_hash' => csrf_hash(),
            ]);
        }

        // cek pembelian kembar
        if ($this->pembelian->cek_kembar(session()->get('kelompok')['id_kelompok'], $item_id)) {
            // sudah pernah dibeli
            return json_encode([
                'response' => $alerts[3],
                'item' => null,
                'coin' => $this->kelompokRally->get_poin(session()->get('kelompok')['id_kelompok']),
                'csrf_name' => csrf_token(),
                'csrf_hash' => csrf_hash(),
            ]);
        }

        // cek scene
        if (intval($items[0]['scene']) != intval(session()->get('kelompok')['scene'])) {
            // salah scene
            return json_encode([
                'response' => $alerts[0],
                'item' => null,
                'coin' => $this->kelompokRally->get_poin(session()->get('kelompok')['id_kelompok']),
                'csrf_name' => csrf_token(),
                'csrf_hash' => csrf_hash(),
            ]);
        }

        // cek poin
        if ($this->kelompokRally->get_poin(session()->get('kelompok')['id_kelompok'])->poin < intval($items[0]['harga'])) {
            // poin ga cukup
            return json_encode([
                'response' => $alerts[2],
                'item' => null,
                'coin' => $this->kelompokRally->get_poin(session()->get('kelompok')['id_kelompok']),
                'csrf_name' => csrf_token(),
                'csrf_hash' => csrf_hash(),
            ]);
        }

        $records = $this->pembelian->get_records();

        // cek urutan beli (khusus herd mentality)
        if (session()->get('kelompok')['scene'] == 3) {
            // beli ga urut
            if (($item_id == 30 && count($this->pembelian->get_specific_record(29)) == 0) || ($item_id == 31 && count($this->pembelian->get_specific_record(30)) == 0)) {
                return json_encode([
                    'response' => $alerts[5],
                    'item' => null,
                    'coin' => $this->kelompokRally->get_poin(session()->get('kelompok')['id_kelompok']),
                    'csrf_name' => csrf_token(),
                    'csrf_hash' => csrf_hash(),
                ]);
            } else if ($item_id == 31) {
                $count = count($this->pembelian->get_specific_record(31));
                $tmp = $items[$count];
                $items = [];
                $items[] = $tmp;
            }
        }

        // beli 5 barang, Tuhan berikan langit baru
        if (
            count($records) + count($items) >= 5 && count($this->pembelian->get_specific_record(6)) == 0 &&
            intval(session()->get('kelompok')['scene']) == 1
        ) {
            $items[] = $this->item->get_item([6])[0];
            $items[] = $this->item->get_item([28])[0];
        }

        // beli bukit bonus tanah bosqu
        if ($item_id == 11) {
            $items[] = $this->item->get_item([8])[0];
        }

        foreach ($items as $i)
            $insert_id[] = $i['id_item'];

        $insert_id = array_unique($insert_id);

        // start transaction
        $this->db->transStart();

        $this->kelompokRally->add_point(session()->get('kelompok')['id_kelompok'], -intval($items[0]['harga']));

        foreach ($insert_id as $i) {
            $this->pembelian->insert([
                'id_kelompok' => session()->get('kelompok')['id_kelompok'],
                'id_item' => $i,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ]);
        }

        // end transaction
        $this->db->transComplete();

        // failed transaction
        if ($this->db->transStatus() === false) {
            return json_encode([
                'response' => $alerts[0],
                'item' => null,
                'coin' => $this->kelompokRally->get_poin(session()->get('kelompok')['id_kelompok']),
                'csrf_name' => csrf_token(),
                'csrf_hash' => csrf_hash(),
            ]);
        }

        return json_encode([
            'response' => $alerts[1],
            'item' => $items,
            'coin' => $this->kelompokRally->get_poin(session()->get('kelompok')['id_kelompok']),
            'csrf_name' => csrf_token(),
            'csrf_hash' => csrf_hash(),
        ]);
    }

    private function getRoute(){
        
        //kalo punya akses semua tampilini semua route yang berkaitan data
        $routesModel = new RBACRouteModel();
        $routes = $routesModel->select("rbac_route.nama as nama_route, rbac_route.route as route")
                                ->like("rbac_route.route", "panitia/games", "after")
                                ->orderBy("rbac_route.nama")
                                ->findAll();

        return $routes;
    }
    public function panitia(){
        $rute = $this->getRoute();
        // dd($rute);
        return view('rally/panitia',['rute'=>$rute]);
    }
}
