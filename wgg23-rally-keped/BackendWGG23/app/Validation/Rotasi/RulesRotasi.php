<?php

namespace App\Validation\Rotasi;
use App\Models\rotasi\RotasiModel;
use App\Models\rotasi\KelompokModel;

class RulesRotasi
{
    protected $rotasiModel;
    protected $kelompokModel;
    function __construct()
    {
        $this->rotasiModel = new RotasiModel;
        $this->kelompokModel = new KelompokModel;
    }
    public function exist($cek)
    {
        $kelompok = $this->kelompokModel->find($cek);
        return $kelompok != null;
    }
    public function unique($cek)
    {
        $rotasi = $this->rotasiModel->where('id_kelompok',$cek)->first();
        return $rotasi == null;
    }
}