<?php

namespace App\Controllers\Pelanggaran;

use App\Controllers\BaseController;
use App\Models\Pelanggaran\TambahPasalModel;
use App\Models\Pelanggaran\TambahAyatModel;
use App\Models\Pelanggaran\TambahPelanggaranModel;
use App\Models\Pelanggaran\TambahPeringatanModel;
use App\Models\Pelanggaran\MahasiswaModel;
use App\Models\PanitiaModel;

class TambahPelanggaranControl extends BaseController
{
    private $modelPasal;
    private $modelAyat;
    private $modelPelanggaran;
    private $modelPeringatan;
    private $mahasiswaModel;
    private $panitiaModel;
    public function __construct()
    {
        $this->modelPasal = new TambahPasalModel;
        $this->modelAyat = new TambahAyatModel;
        $this->modelPelanggaran = new TambahPelanggaranModel;
        $this->modelPeringatan = new TambahPeringatanModel;
        $this->mahasiswaModel = new MahasiswaModel;
        $this->panitiaModel = new PanitiaModel;
    }

    public function index()
    {
        $data['dataPasal'] = $this->modelPasal->tampilkan_data();
        $data['dataAyat'] = $this->modelAyat->tampilkan_data();
        return view('Pelanggaran/TambahPelanggaran', $data);
    }

    public function tambah()
    {
        $result = $_POST['AyatTerlanggar'];
        $result_explode = explode('|', $result);
        $fail = false;

        $skip = $this->request->getVar('skipPeringatan');
        $existInPelanggaran = $this->modelPelanggaran->exist($this->request->getVar('nRPMahasiswa'), $result_explode[0], $this->request->getVar('tanggalMelanggar'));
        $existInPeringatan = $this->modelPeringatan->exist($this->request->getVar('nRPMahasiswa'), $result_explode[0], $this->request->getVar('tanggalMelanggar'));
        $MahasiswaExist = $this->mahasiswaModel->exist($this->request->getVar('nRPMahasiswa'));
        $poinPasal = $this->modelPasal->fetch_poin($this->request->getVar(('pasalTerlanggar')));

        $countPelanggaran = count($existInPelanggaran);
        $countPeringatan = count($existInPeringatan);
        $countMahasiswa = count($MahasiswaExist);

        $idPerekap = $this->getIdPanitia(session()->get('nrp'));

        $perekapFound = true;

        if($idPerekap == false){
            $perekapFound = false;
        }

        if (($countPelanggaran > 0 || $countPeringatan > 0 || $result_explode[2] == 0 || $skip == true) && $countMahasiswa == 1 && $perekapFound == true) {
            $this->modelPelanggaran->TambahPelanggaran([
                'nrp' => strtoupper($this->request->getVar('nRPMahasiswa')),
                'pasalTerlanggar' => $result_explode[1],
                'ayatTerlanggar' => $result_explode[0],
                'keterangan' => $this->request->getVar('keterangan'),
                'poin' => $poinPasal->JumlahPoin,
                'tanggalMelanggar' => $this->request->getVar('tanggalMelanggar'),
                'id_perekap' => $idPerekap,
                'idPasal' => $result_explode[3]
            ]);
        } else if (($countPelanggaran < 1 && $countPeringatan < 1 && $result_explode[2] == 1) && $countMahasiswa == 1 && $perekapFound == true) {
            $this->modelPeringatan->TambahPeringatan([
                'nrp' => strtoupper($this->request->getVar('nRPMahasiswa')),
                'pasalTerlanggar' => $result_explode[1],
                'ayatTerlanggar' => $result_explode[0],
                'keterangan' => $this->request->getVar('keterangan'),
                'poin' => $poinPasal->JumlahPoin,
                'tanggalMelanggar' => $this->request->getVar('tanggalMelanggar'),
                'id_perekap' => $idPerekap,
                'idPasal' => $result_explode[3]
            ]);
        } else {
            $fail = true;
        }

        if ($fail == false) {
            return redirect()
                ->to(site_url('/panitia/pelanggaran/TambahPelanggaran'))
                ->with('msg_success', 'Data berhasil ditambahkan');
        } else {
            if($perekapFound == false){
                return redirect()
                ->to(site_url('/panitia/pelanggaran/TambahPelanggaran'))
                ->with('msg_panitiaNotFound', 'NRP Perekap Tidak Ditemukan');
            } else {
            return redirect()
                ->to(site_url('/panitia/pelanggaran/TambahPelanggaran'))
                ->with('msg_unsuccess', 'Data gagal ditambahkan');
            }
        }
    }

    private function getIdPanitia($nrp)
    {
        $panitia = $this->panitiaModel
            ->select('id')
            ->where('nrp', strtoupper($nrp))
            ->first();
        return ($panitia) ? $panitia['id'] : false;
    }

    public function getMahasiswa($nrp)
    {
        $dataMahasiswa = $this->mahasiswaModel->fetch_mahasiswa($nrp);

        if (!$dataMahasiswa) {
            $columnNama = NULL;
            $columnNRP = NULL;
            $columnJurusan = NULL;
        } else {
            $columnNama = $dataMahasiswa->nama;
            $columnNRP = $dataMahasiswa->nrp;
            $columnJurusan = $dataMahasiswa->prodi;
        }
        return $this->response
            ->setStatusCode('200')
            ->setJSON(['nrp' => $columnNRP, 'nama' => $columnNama, 'jurusan' => $columnJurusan]);
    }

    public function getAyat($bab)
    {
        $dataAyat = $this->modelAyat->tampilkan_data_Bersyarat($bab);

        $response = [];

        if (!$dataAyat) {
            $response = [];
        } else {
            $response = [
                'dataAyat' => $dataAyat
            ];
        }

        return $this->response
            ->setStatusCode('200')
            ->setJSON($response);
    }
}