<?php

namespace App\Controllers\Pelanggaran;

use App\Controllers\BaseController;
use App\Models\Pelanggaran\TambahPasalModel;
use App\Models\Pelanggaran\TambahPelanggaranModel;
use App\Models\Pelanggaran\TambahPeringatanModel;

class TambahPasalControl extends BaseController
{
    private $modelPasal;
    private $modelPelanggaran;
    private $modelPeringatan;
    public function __construct()
    {
        $this->modelPasal = new TambahPasalModel;
        $this->modelPelanggaran = new TambahPelanggaranModel;
        $this->modelPeringatan = new TambahPeringatanModel;
    }

    public function index()
    {
        return view('Pelanggaran/TambahPasal');
    }

    public function tambah()
    {
        // $pasalExist = $this->modelPasal->exist($this->request->getVar('babPasal'));
        // $countPasal = count($pasalExist);
        // $fail = false;

        // if ($countPasal < 1) {
            $tambahPasal = $this->modelPasal->tambahPasal([
                'Bab' => strtoupper($this->request->getVar('babPasal')),
                'Keterangan' => $this->request->getVar('keteranganPasal'),
                'JumlahPoin' => $this->request->getVar('jumlahPoin')
            ]);
        // } else {
            // $fail = true;
        // }

        if (/*$fail == false*/ $this->modelPasal->db->affectedRows() > 0) {
            return redirect()
                ->to(site_url('/panitia/pelanggaran/TambahPasal'))
                ->with('msg_success', 'Data berhasil ditambahkan');
        } else {
            return redirect()
                ->to(site_url('/panitia/pelanggaran/TambahPasal'))
                ->with('msg_unsuccess', 'Data gagal ditambahkan');
        }
    }

    public function hapus($ID)
    {
        $delete['del_data'] = $this->modelPasal->hapus_data($ID);
        return redirect()
            ->to(site_url('/panitia/pelanggaran/pasalList'));
    }

    public function edit($ID)
    {
        $data['fetch_data'] = $this->modelPasal->fetch_data($ID);
        $data['dataPasal'] = $this->modelPasal->tampilkan_data();
        return view('Pelanggaran/editPasal', $data);
    }

    public function edit_data()
    {
        $this->modelPasal->edit_data([
            'Bab' => strtoupper($this->request->getVar('babPasal')),
            'Keterangan' => $this->request->getVar('keteranganPasal'),
            'poin' => $this->request->getVar('jumlahPoin'),
        ]);

        $this->modelPelanggaran->edit_data([
            'Bab' => $this->request->getVar('babPasal'),
            'poin' => $this->request->getVar('jumlahPoin'),
        ]);

        $this->modelPeringatan->edit_data([
            'Bab' => $this->request->getVar('babPasal'),
            'poin' => $this->request->getVar('jumlahPoin'),
        ]);

        $data['dataAyat'] = $this->modelPasal->tampilkan_data();
        return redirect()
            ->to(site_url('/panitia/pelanggaran/pasalList'));
    }
}