<?php

namespace App\Controllers\Pelanggaran;

use App\Controllers\BaseController;
use App\Models\Pelanggaran\TambahPasalModel;
use App\Models\Pelanggaran\TambahAyatModel;
use App\Models\Pelanggaran\TambahPelanggaranModel;
use App\Models\Pelanggaran\TambahPeringatanModel;

class TambahAyatControl extends BaseController
{
    private $model;
    private $modelAyat;
    private $modelPelanggaran;
    private $modelPeringatan;
    public function __construct()
    {
        $this->model = new TambahPasalModel;
        $this->modelAyat = new TambahAyatModel;
        $this->modelPelanggaran = new TambahPelanggaranModel;
        $this->modelPeringatan = new TambahPeringatanModel;
    }

    public function index()
    {
        $data['dataPasal'] = $this->model->tampilkan_data();
        return view('Pelanggaran/TambahAyat', $data);
    }

    public function tambah()
    {
        $dataPasal = $_POST['pasalAyat'];
        $dataPasal_explode = explode('|', $dataPasal);

        echo $dataPasal_explode[1];
        $this->modelAyat->tambahAyat([
            'idPasal' => $dataPasal_explode[1],
            'Pasal' => $dataPasal_explode[0],
            'Keterangan' => $this->request->getVar('keteranganAyat'),
            'sistemTegur' => $this->request->getVar('sistemTegur')
        ]);

        if ($this->model->db->affectedRows() > 0) {
            return redirect()
                ->to(site_url('/panitia/pelanggaran/TambahAyat'))
                ->with('msg_success', 'Data berhasil ditambahkan');
        } else {
            return redirect()
                ->to(site_url('/panitia/pelanggaran/TambahAyat'))
                ->with('msg_unsuccess', 'Data gagal ditambahkan');
        }
    }

    public function hapus($ID)
    {
        $delete['del_data'] = $this->modelAyat->hapus_data($ID);
        return redirect()
            ->to(site_url('/panitia/pelanggaran/list'));
    }

    public function edit($ID)
    {
        $data['fetch_data'] = $this->modelAyat->fetch_data($ID);
        $data['dataAyat'] = $this->modelAyat->tampilkan_data();
        $data['dataPasal'] = $this->model->tampilkan_data();
        return view('Pelanggaran/EditAyat', $data);
    }

    public function edit_data()
    {
        $dataPasal = $_POST['pasalAyat'];
        $dataPasal_explode = explode('|', $dataPasal);
        $idPasalFetch = $this->model->fetch_data($dataPasal_explode[0]);

        if(count($dataPasal_explode) == 3){
            $this->modelAyat->edit_data([
                'Pasal' => $dataPasal_explode[0],
                'Keterangan' => $this->request->getVar('keteranganAyat'),
                'sistemTegur' => $this->request->getVar('sistemTegur'),
                'ID' => $this->request->getVar('ID'),
                'idPasal' => $dataPasal_explode[1]
            ]);
    
            $this->modelPelanggaran->edit_data_ayat([
                'idPasal' => $dataPasal_explode[1],
                'Bab' => $dataPasal_explode[0],
                'poin' => $dataPasal_explode[2],
                'ID' => $this->request->getVar('ID'),
            ]);
    
            $this->modelPeringatan->edit_data_ayat([
                'idPasal' => $dataPasal_explode[1],
                'Bab' => $dataPasal_explode[0],
                'poin' => $dataPasal_explode[2],
                'ID' => $this->request->getVar('ID'),
            ]);
        } else {
            $this->modelAyat->edit_data([
                'Pasal' => $dataPasal_explode[0],
                'Keterangan' => $this->request->getVar('keteranganAyat'),
                'sistemTegur' => $this->request->getVar('sistemTegur'),
                'ID' => $this->request->getVar('ID'),
                'idPasal' => $idPasalFetch->id
            ]);
        }

        // $this->modelAyat->edit_data([
        //     'Pasal' => $dataPasal_explode[0],
        //     'Keterangan' => $this->request->getVar('keteranganAyat'),
        //     'sistemTegur' => $this->request->getVar('sistemTegur'),
        //     'ID' => $this->request->getVar('ID'),
        //     'idPasal' => $dataPasal_explode[1]
        // ]);

        // $this->modelPelanggaran->edit_data_ayat([
        //     'idPasal' => $dataPasal_explode[1],
        //     'Bab' => $dataPasal_explode[0],
        //     'poin' => $dataPasal_explode[2],
        //     'ID' => $this->request->getVar('ID'),
        // ]);

        // $this->modelPeringatan->edit_data_ayat([
        //     'idPasal' => $dataPasal_explode[1],
        //     'Bab' => $dataPasal_explode[0],
        //     'poin' => $dataPasal_explode[2],
        //     'ID' => $this->request->getVar('ID'),
        // ]);

        $data['dataAyat'] = $this->modelAyat->tampilkan_data();
        return redirect()
            ->to(site_url('/panitia/pelanggaran/list'));
    }
}