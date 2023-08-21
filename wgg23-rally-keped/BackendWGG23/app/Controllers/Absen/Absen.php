<?php

namespace App\Controllers\Absen;

use App\Controllers\BaseController;
use App\Models\Absen\AbsensiPanitiaModel;
use App\Models\Absen\KegiatanPanitiaModel;
use App\Models\PanitiaModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Absen\AbsensiMabaModel;
use App\Models\Absen\KegiatanMabaModel;
use App\Models\MahasiswaModel;
use CodeIgniter\Model;

class Absen extends BaseController
{
    private $models;
    private Model $absensiPesertaModel, $kegiatanPesertaModel, $pesertaModel, $panitiaModel;

    public function __construct()
    {
        $this->models = [];
        $this->models['panitia'] = [
            new AbsensiPanitiaModel(),
            new KegiatanPanitiaModel(),
            new PanitiaModel(),
        ];
        $this->models['maba'] = [
            new AbsensiMabaModel(),
            new KegiatanMabaModel(),
            new MahasiswaModel(),
        ];
        $this->panitiaModel = $this->models['panitia'][2];
    }

    private function setModels($tipePeserta)
    {
        [$this->absensiPesertaModel, $this->kegiatanPesertaModel, $this->pesertaModel] = $this->models[$tipePeserta];
    }

    public function regisIn($tipePeserta, $idKegiatan)
    {
        date_default_timezone_set('asia/jakarta');
        $this->setModels($tipePeserta);

        $kegiatan = $this->kegiatanPesertaModel
            ->select('id, nama, tanggal, start_regis_in, end_regis_in, start_regis_out, end_regis_out')
            ->where('id', $idKegiatan)
            ->first();
        // dd($this->kegiatanPesertaModel->find($idKegiatan));
        if ($kegiatan === null)
            return redirect()->to(site_url("panitia/absen/$tipePeserta/kegiatan"))
                ->with('response', ['isSuccess' => false, 'message' => 'Kegiatan tidak ditemukan']);

        if ($this->request->getMethod() === 'get') {
            $data['title'] = 'Regis-In ' . $kegiatan['nama'];
            $data['kegiatan'] = $kegiatan;
            $data['tipePeserta'] = $tipePeserta;
            return view('absen/absen', $data);
        }

        $rules = [
            'nrp' => [
                'rules' => 'required|regex_match[/^[a-h][0-9]{8}$/i]|is_not_unique[' . (($tipePeserta === 'panitia') ? $tipePeserta : 'mahasiswa') . '.nrp]',
                'errors' => [
                    'required' => 'Silahkan scan NRP',
                    'regex_match' => 'NRP tidak valid',
                    'is_not_unique' => 'NRP {value} tidak terdaftar di database',
                ],
            ],
        ];
        $nrpPeserta = strtoupper($this->request->getPost('nrp'));

        $body = ['isSuccess' => false, 'message' => '', 'csrf' => csrf_hash(), 'tipePeserta' => $tipePeserta];
        if (!$this->validate($rules)) {
            $body['message'] = $this->validator->getError('nrp');
            return $this->response
                ->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON($body);
        }

        $nrpPengabsen = strtoupper(session('nrp'));
        $pengabsen = $this->panitiaModel
            ->select('id')
            ->where('nrp', $nrpPengabsen)
            ->first();
        
        if (!$pengabsen) {
            $body['message'] = 'NRP pengabsen tidak ditemukan';
            return $this->response
                ->setStatusCode(ResponseInterface::HTTP_FORBIDDEN)
                ->setJSON($body);
        }

        if ($tipePeserta === 'panitia') {
            $peserta = $this->pesertaModel
                ->select('id, nama, nrp, divisi')
                ->where('nrp', $nrpPeserta)
                ->first();
        } else {
            $peserta = $this->pesertaModel
                ->select('mahasiswa.id, mahasiswa.nama, mahasiswa.nrp, mahasiswa.prodi, kelompok.nama as kelompok')
                ->join('kelompok', 'kelompok.id = mahasiswa.id_kelompok')
                ->where('nrp', $nrpPeserta)
                ->first();
        }

        if (!$peserta) {
            $body['message'] = "$nrpPeserta tidak ditemukan di database";
            return $this->response
                ->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON($body);
        }
        $body['nama'] = $peserta['nama'];
        $body['nrp'] = $peserta['nrp'];
        if ($tipePeserta === 'panitia') {
            $body['divisi'] = $peserta['divisi'];
        } else {
            $body['kelompok'] = $peserta['kelompok'];
            $body['prodi'] = $peserta['prodi'];
        }

        $absen = $this->absensiPesertaModel
            ->select('id, jam_regis_in')
            ->where('id_kegiatan', $idKegiatan)
            ->where('id_' . $tipePeserta, $peserta['id'])
            ->first();
        
        if (!empty($absen)) {
            if ($absen['jam_regis_in'] !== NULL) {
                $body['isSuccess'] = true;
                $body['message'] = "$nrpPeserta sudah melakukan Regis-In.";
                return $this->response
                    ->setStatusCode(ResponseInterface::HTTP_OK)
                    ->setJSON($body);
            }
            // update
            $isUpdateSuccess = $this->absensiPesertaModel
                ->update($absen['id'], [
                    'jam_regis_in' => date('H:i:s', strtotime('now')),
                    'last_updated_by' => $pengabsen['id'],
                ]);
            if (!$isUpdateSuccess) {
                $body['message'] = "Regis-in $nrpPeserta gagal. Silahkan coba lagi!";
                return $this->response
                    ->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                    ->setJSON($body);
            }
            $body['isSuccess'] = true;
            $body['message'] = "Regis-in $nrpPeserta berhasil.";
            return $this->response
                ->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON($body);
        }
        // insert
        $isInsertSuccess = $this->absensiPesertaModel
            ->insert([
                'id_kegiatan' => $idKegiatan,
                'id_' . $tipePeserta => $peserta['id'],
                'jam_regis_in' => date('H:i:s', strtotime('now')),
                'last_updated_by' => $pengabsen['id'],
            ]);
        
        if (!$isInsertSuccess) {
            $body['message'] = "Regis-in $nrpPeserta gagal. Silahkan coba lagi!";
            return $this->response
                ->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON($body);
        }

        $body['isSuccess'] = true;
        $body['message'] = "Regis-in $nrpPeserta berhasil.";
        return $this->response
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setJSON($body);
    }

    public function regisOut($tipePeserta, $idKegiatan)
    {
        date_default_timezone_set('asia/jakarta');
        $this->setModels($tipePeserta);

        $kegiatan = $this->kegiatanPesertaModel
            ->select('id, nama, tanggal, start_regis_in, end_regis_in, start_regis_out, end_regis_out')
            ->where('id', $idKegiatan)
            ->first();

            if ($kegiatan === null)
                return redirect()->to(site_url("panitia/absen/$tipePeserta/kegiatan"))
                    ->with('response', ['isSuccess' => false, 'message' => 'Kegiatan ' . (($tipePeserta === 'panitia') ? ucwords($tipePeserta) : 'Mahasiswa Baru') . ' tidak ditemukan']);

        if ($this->request->getMethod() === 'get') {
            $data['title'] = 'Regis-Out ' . $kegiatan['nama'];
            $data['kegiatan'] = $kegiatan;
            $data['tipePeserta'] = $tipePeserta;
            return view('absen/absen', $data);
        }

        $rules = [
            'nrp' => [
                'rules' => 'required|regex_match[/^[a-h][0-9]{8}$/i]|is_not_unique[' . (($tipePeserta === 'panitia') ? $tipePeserta : 'mahasiswa') . '.nrp]',
                'errors' => [
                    'required' => 'Silahkan scan NRP',
                    'regex_match' => 'NRP tidak valid',
                    'is_not_unique' => 'NRP {value} tidak terdaftar di database',
                ],
            ],
        ];
        $nrpPeserta = strtoupper($this->request->getPost('nrp'));

        $body = ['isSuccess' => false, 'message' => '', 'csrf' => csrf_hash(), 'tipePeserta' => $tipePeserta];
        if (!$this->validate($rules)) {
            $body['message'] = $this->validator->getError('nrp');
            return $this->response
                ->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON($body);
        }

        $nrpPengabsen = strtoupper(session('nrp'));
        $pengabsen = $this->panitiaModel
            ->select('id')
            ->where('nrp', $nrpPengabsen)
            ->first();
        
        if (!$pengabsen) {
            $body['message'] = 'NRP pengabsen tidak ditemukan';
            return $this->response
                ->setStatusCode(ResponseInterface::HTTP_FORBIDDEN)
                ->setJSON($body);
        }

        if ($tipePeserta === 'panitia') {
            $peserta = $this->pesertaModel
                ->select('id, nama, nrp, divisi')
                ->where('nrp', $nrpPeserta)
                ->first();
        } else {
            $peserta = $this->pesertaModel
                ->select('mahasiswa.id, mahasiswa.nama, mahasiswa.nrp, mahasiswa.prodi, kelompok.nama as kelompok')
                ->join('kelompok', 'kelompok.id = mahasiswa.id_kelompok')
                ->where('nrp', $nrpPeserta)
                ->first();
        }

        if (!$peserta) {
            $body['message'] = "$nrpPeserta tidak ditemukan di database";
            return $this->response
                ->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON($body);
        }
        $body['nama'] = $peserta['nama'];
        $body['nrp'] = $peserta['nrp'];
        if ($tipePeserta === 'panitia') {
            $body['divisi'] = $peserta['divisi'];
        } else {
            $body['kelompok'] = $peserta['kelompok'];
            $body['prodi'] = $peserta['prodi'];
        }
        
        $absen = $this->absensiPesertaModel
            ->select('id, jam_regis_out')
            ->where('id_kegiatan', $idKegiatan)
            ->where('id_' . $tipePeserta, $peserta['id'])
            ->first();

        // insert
        if (empty($absen)) {
            $isInsertSuccess = $this->absensiPesertaModel
                ->insert([
                    'id_kegiatan' => $idKegiatan,
                    'id_' . $tipePeserta => $peserta['id'],
                    'jam_regis_out' => date('H:i:s', strtotime('now')),
                    'last_updated_by' => $pengabsen['id'],
                ]);
            if (!$isInsertSuccess) {
                $body['message'] = "Regis-out $nrpPeserta gagal. Silahkan coba lagi!";
                return $this->response
                    ->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                    ->setJSON($body);
            }
            $body['isSuccess'] = true;
            $body['message'] = "Regis-out $nrpPeserta berhasil.";
            
            return $this->response
                ->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON($body);
        }

        if ($absen['jam_regis_out'] !== NULL) {
            $body['isSuccess'] = true;
            $body['message'] = "$nrpPeserta sudah melakukan Regis-Out.";
            
            return $this->response
                ->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON($body);
        }

        $isUpdateSuccess = $this->absensiPesertaModel
            ->update($absen['id'], [
                'jam_regis_out' => date('H:i:s', strtotime('now')),
            ]);
        if (!$isUpdateSuccess) {
            $body['message'] = "Regis-out $nrpPeserta gagal. Silahkan coba lagi!";
            return $this->response
                ->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON($body);
        }
        $body['isSuccess'] = true;
        $body['message'] = "Regis-out $nrpPeserta berhasil.";
        return $this->response
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setJSON($body);
    }
}