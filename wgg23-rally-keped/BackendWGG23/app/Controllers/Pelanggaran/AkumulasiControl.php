<?php

namespace App\Controllers\Pelanggaran;

use App\Controllers\BaseController;
use App\Models\Pelanggaran\MahasiswaModel;
use App\Models\Pelanggaran\TambahPelanggaranModel;
use App\Models\Pelanggaran\TambahPasalModel;
use App\Models\Pelanggaran\TambahPeringatanModel;
use App\Models\Pelanggaran\TambahAyatModel;
use App\Models\PanitiaModel;


class AkumulasiControl extends BaseController
{
    private $modelPasal;
    private $modelAyat;
    private $modelPelanggaran;
    private $modelPeringatan;
    private $mahasiswaModel;
    private $panitiaModel;
    public function __construct(){
        $this->modelPasal = new TambahPasalModel;
        $this->modelAyat = new TambahAyatModel;
        $this->modelPelanggaran = new TambahPelanggaranModel;
        $this->modelPeringatan = new TambahPeringatanModel;
        $this->mahasiswaModel = new MahasiswaModel;
        $this->panitiaModel = new PanitiaModel;
    }
    
    public function index()
    {   
        $data['pelanggaranJoined'] = $this->modelPelanggaran->getPelanggaran();
        $data['peringatanJoined'] = $this->modelPeringatan->getPeringatan();

        // $data['dataPasal'] = $this->modelPasal->tampilkan_data();
        // $data['dataAyat'] = $this->modelAyat->tampilkan_data();
        // $data['dataMahasiswa'] = $this->mahasiswaModel->tampilkan_data();
        // $data['dataPeringatan'] = $this->modelPeringatan->tampilkan_data();

        $data['dataPelanggaran'] = $this->modelPelanggaran->tampilkan_data();
        return view('Pelanggaran/AkumulasiPoin', $data);
    }

    public function detail($nrp){

        $data['pelanggaranJoined'] = $this->modelPelanggaran->getPelanggaranDetail($nrp);
        $data['peringatanJoined'] = $this->modelPeringatan->getPeringatanDetail($nrp);
        
        // $data['fetch_pelanggaran'] = $this->modelPelanggaran->fetch_pelanggaran($nrp);
        // $data['fetch_peringatan'] = $this->modelPeringatan->fetch_peringatan($nrp);
        // $data['fetch_mahasiswa'] = $this->mahasiswaModel->fetch_mahasiswa($nrp);
        // $data['dataAyat'] = $this->modelAyat->tampilkan_data_deleted();
        // $data['dataPasal'] = $this->modelPasal->tampilkan_data_deleted();
        // $data['dataPanitia'] = $this->panitiaModel->pelanggaran_tampilkan_data();
        return view('Pelanggaran/poinSpesifik', $data);
    }

    public function hapusPelanggaran($ID, $nrp){
        $delete['del_data'] = $this->modelPelanggaran->hapus_data($ID);
        return redirect()
            ->to(site_url('/panitia/pelanggaran/detailSpesifik' . $nrp));
    }

    public function hapusPeringatan($ID, $nrp){
        $delete['del_data'] = $this->modelPeringatan->hapus_data($ID);
        return redirect()
            ->to(site_url('/panitia/pelanggaran/detailSpesifik' . $nrp));
    }
}
