<?php

namespace App\Validation\ijin;
use App\Models\Ijin\IjinTanggalModel;
use App\Models\Ijin\IjinModel;

class RulesIjin
{
    private $ijinTanggalModel;
    private $ijinModel;
    function __construct()
    {
        $this->ijinTanggalModel = new IjinTanggalModel;
        $this->ijinModel = new IjinModel;
    }
    public function cek_tanggal($cek):bool
    {
        $ijinTanggal = $this->ijinTanggalModel
        ->select()
        ->where('open',1)
        ->findAll();
        $bool = false;
        foreach($ijinTanggal as $ijin){
            if($ijin['id'] == $cek){
                $bool = true;
                break;
            }
        }
        return $bool;
    }
    public function cek_tanggalAll($cek):bool
    {
        $ijinTanggal = $this->ijinTanggalModel
        ->findAll();
        $bool = false;
        foreach($ijinTanggal as $ijin){
            if($ijin['id'] == $cek){
                $bool = true;
                break;
            }
        }
        return $bool;
    }
    public function cek_jenis($cek):bool
    {
        $jenisAcc = [1,2];
        return in_array($cek,$jenisAcc);
    }
    public function cek_aksi($cek):bool
    {
        $aksiAcc = [1,2];
        return in_array($cek,$aksiAcc);
    }
    public function cek_ubah($cek):bool
    {
        $aksiAcc = [0,1];
        return in_array($cek,$aksiAcc);
    }
    public function cek_id($cek):bool
    {
        $ijin = $this->ijinModel
        ->findAll();
        $bool = false;
        foreach($ijin as $i){
            if($i['id'] == $cek){
                $bool = true;
                break;
            }
        }
        return $bool;
    }
    public function cek_kembar($cek):bool
    {
        $ijinTanggal = $this->ijinTanggalModel
        ->findAll();
        $bool = true;
        foreach($ijinTanggal as $i){
            if($i['tanggal'] == $cek){
                $bool = false;
                break;
            }
        }
        return $bool;
    }
}