<?php

namespace App\Controllers\Data;

use App\Controllers\BaseController;
use App\Models\FakultasModel;
use App\Models\ProdiModel;

class Master extends BaseController
{
    public function viewFakultas()
    {
        //
        $fakultasModel = new FakultasModel();

        $fakultas = $fakultasModel->findAll();

        $data['fakultas'] = $fakultas;

        return view('data/master/fakultas', $data);
    }
    
    public function viewProdi()
    {
        //
        $prodiModel = new ProdiModel();

        $prodiModel->join('master_fakultas as f', 'master_prodi.fakultas = f.id');
        $prodiModel->join('(SELECT prodi, count(*) as jumlah_mahasiswa  FROM mahasiswa WHERE deleted_at IS NULL GROUP BY prodi) as m', 'master_prodi.nama = m.prodi', 'left');
        $prodi = $prodiModel->select("f.kode as kode_fakultas, master_prodi.kode as urutan_prodi, master_prodi.nama, master_prodi.nama_inggris, IFNULL(jumlah_mahasiswa, 0) as jumlah_mahasiswa")->findAll();
  
        $data['prodi'] = $prodi;

        return view('data/master/prodi', $data);
    }
}
