<?php

namespace App\Controllers\Pelanggaran;

use App\Controllers\BaseController;
use App\Models\Pelanggaran\MahasiswaModel;
use App\Models\Pelanggaran\PesertaViewModel;

class DataPelanggaranControl extends BaseController
{
    private $mahasiswaModel;
    private $pesertaViewModel;
    public function __construct(){
        $this->mahasiswaModel = new MahasiswaModel;
        $this->pesertaViewModel = new PesertaViewModel;
    }
    
    public function index()
    {
        $data['title'] = 'Rekap';
        $nrp = strtoupper(session()->get('nrp'));
        // $nrp = "C14230078"; //

        if($nrp == false){
            $data['joined'] = null;
            return view('Pelanggaran/pesertaView', $data);
        }

        $data['joined'] = $this->pesertaViewModel->getPelanggaran($nrp);
        // $data['fetch_pelanggaran'] = $this->modelPelanggaran->fetch_pelanggaran($nrp);
        // $data['fetch_peringatan'] = $this->modelPeringatan->fetch_peringatan($nrp);
        // $data['fetch_mahasiswa'] = $this->mahasiswaModel->fetch_mahasiswa($nrp);
        // $data['dataAyat'] = $this->modelAyat->tampilkan_data_deleted();
        // $data['dataPasal'] = $this->modelPasal->tampilkan_data_deleted();
        return view('Pelanggaran/pesertaView', $data);
       
    }

    private function getIdMahasiswa($nrp)
    {
        $mahasiswa = $this->mahasiswaModel
            ->select('id')
            ->where('nrp', strtoupper($nrp))
            ->first();
        return ($mahasiswa) ? $mahasiswa['id'] : false;
    }
}
