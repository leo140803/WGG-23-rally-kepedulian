<?php

namespace App\Controllers\Pelanggaran;

use App\Controllers\BaseController;
use App\Models\Pelanggaran\ListModel;
use App\Models\Pelanggaran\TambahPasalModel;

class ListControl extends BaseController
{
    private $modelAyat;
    private $modelPasal;
    public function __construct(){
        $this->modelAyat = new ListModel;
        $this->modelPasal = new TambahPasalModel;
    }

    public function index()
    {
        $data['dataAyat'] = $this->modelAyat->tampilkan_data();
        $data['dataPasal'] = $this->modelPasal->tampilkan_data_deleted();
        return view('Pelanggaran/List', $data);
    }

    public function pasalIndex(){
        $data['dataPasal'] = $this->modelPasal->tampilkan_data();
        return view('Pelanggaran/dataPasal', $data);
    }
}
