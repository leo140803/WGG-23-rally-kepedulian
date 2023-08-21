<?php

namespace App\Controllers\Absen;

use App\Controllers\BaseController;
use App\Models\Absen\KegiatanMabaModel;
use App\Models\Absen\KegiatanPanitiaModel;
use CodeIgniter\Entity\Cast\DatetimeCast;
use CodeIgniter\Model;
use DateTime;

class Kegiatan extends BaseController
{
    private $models;
    private Model $kegiatanPesertaModel;

    public function __construct()
    {
        $this->models = [
            'panitia' => new KegiatanPanitiaModel(),
            'maba' => new KegiatanMabaModel(),
        ];
    }

    private function setModel($tipePeserta) {
        $this->kegiatanPesertaModel = $this->models[$tipePeserta];
    }

    public function index($tipePeserta)
    {
        $this->setModel($tipePeserta);
        $data['title'] = 'Kegiatan ' . (($tipePeserta === 'panitia') ? ucwords($tipePeserta) : 'Mahasiswa Baru');
        $data['listKegiatan'] = $this->kegiatanPesertaModel
            ->select('id, nama, tanggal, start_regis_in, start_regis_out')
            ->orderBy('tanggal')
            ->findAll();
        $data['tipePeserta'] = $tipePeserta;

        return view('absen/kegiatan', $data);
    }

    public function create($tipePeserta)
    {
        $this->setModel($tipePeserta);
        $rules = [
            'nama-kegiatan' => [
                'rules' => 'required|max_length[64]',
                'errors' => [
                    'required' => 'Nama kegiatan wajib diisi!',
                    'max_length' => 'Nama kegiatan maksimal 64 karakter',
                ],
            ],
            'tanggal' => [
                'rules' => 'required|valid_date[d/m/Y]|date_not_passed',
                'errors' => [
                    'required' => 'Tanggal kegiatan wajib diisi!',
                    'valid_date' => 'Tanggal kegiatan tidak valid',
                    'date_not_passed' => 'Tanggal sudah lewat',
                ],
            ],
            'start-regis-in' => [
                'rules' => 'required|valid_time|time_not_passed[tanggal]',
                'errors' => [
                    'required' => 'Waktu mulai regis-in wajib diisi!',
                    'valid_time' => 'Waktu mulai regis-in tidak valid',
                    'time_not_passed' => 'Waktu mulai regis-in sudah lewat',
                ],
            ],
            'end-regis-in' => [
                'rules' => 'required|valid_time|later_than[start-regis-in]|time_not_passed[tanggal]',
                'errors' => [
                    'required' => 'Waktu berakhir regis-in wajib diisi!',
                    'valid_time' => 'Waktu berakhir regis-in tidak valid',
                    'later_than' => 'Waktu berakhir regis-in harus lebih akhir dari waktu mulai regis-in',
                    'time_not_passed' => 'Waktu berakhir regis-in sudah lewat',
                ],
            ],
            'start-regis-out' => [
                'rules' => 'required|valid_time|later_than[start-regis-in]|time_not_passed[tanggal]',
                'errors' => [
                    'required' => 'Waktu mulai regis-out wajib diisi!',
                    'valid_time' => 'Waktu mulai regis-out tidak valid',
                    'later_than' => 'Waktu mulai regis-out harus lebih akhir dari waktu mulai regis-in',
                    'time_not_passed' => 'Waktu mulai regis-out sudah lewat',
                ],
            ],
            'end-regis-out' => [
                'rules' => 'required|valid_time|later_than[start-regis-out]|time_not_passed[tanggal]',
                'errors' => [
                    'required' => 'Waktu berakhir regis-out wajib diisi!',
                    'valid_time' => 'Waktu berakhir regis-out tidak valid',
                    'later_than' => 'Waktu berakhir regis-out harus lebih akhir dari waktu mulai regis-out',
                    'time_not_passed' => 'Waktu berakhir regis-out sudah lewat',
                ],
            ],
        ];
        if (!$this->validate($rules)) 
            return redirect()->back()
                ->withInput();

        $isInsertSuccess = $this->kegiatanPesertaModel->insert([
            'nama' => $this->request->getPost('nama-kegiatan'),
            'tanggal' => Kegiatan::reformatDate($this->request->getPost('tanggal')),
            'start_regis_in' => $this->request->getPost('start-regis-in'),
            'end_regis_in' => $this->request->getPost('end-regis-in'),
            'start_regis_out' => $this->request->getPost('start-regis-out'),
            'end_regis_out' => $this->request->getPost('end-regis-out'),
        ]);

        if (!$isInsertSuccess) 
            return redirect()->back()
                ->with('response', ['isSuccess' => false, 'message' => 'Kegiatan gagal disimpan ke database'])
                ->withInput();
        
        return redirect()->back()
            ->with('response', ['isSuccess' => true, 'message' => 'Kegiatan berhasil disimpan ke database']);
    }

    public function delete($tipePeserta, $idKegiatan)
    {
        $this->setModel($tipePeserta);
        $isDeleted = $this->kegiatanPesertaModel->delete($idKegiatan);
        if (!$isDeleted) 
            return redirect()->back()
                ->with('response', ['isSuccess' => false, 'message' => 'Kegiatan gagal dihapus']);
        
        return redirect()->back()
            ->with('response', ['isSuccess' => true, 'message' => 'Kegiatan berhasil dihapus']);
    }

    public function formEditKegiatan($tipePeserta, $idKegiatan)
    {
        $this->setModel($tipePeserta);
        $kegiatan = $this->kegiatanPesertaModel
            ->select('id, nama, tanggal, start_regis_in, end_regis_in, start_regis_out, end_regis_out')
            ->where('id', $idKegiatan)
            ->first();
        if ($kegiatan === null) 
            return redirect()->to(site_url("panitia/absen/$tipePeserta/kegiatan"))
                ->with('response', [
                    'isSuccess' => false,
                    'message' => 'Kegiatan tidak ditemukan di database', 
                ]);

        $data['title'] = $kegiatan['nama'];
        $kegiatan['tanggal'] = date('d/m/Y', strtotime($kegiatan['tanggal']));
        $kegiatan['start_regis_in'] = Kegiatan::reformatTime($kegiatan['start_regis_in']);
        $kegiatan['end_regis_in'] = Kegiatan::reformatTime($kegiatan['end_regis_in']);
        $kegiatan['start_regis_out'] = Kegiatan::reformatTime($kegiatan['start_regis_out']);
        $kegiatan['end_regis_out'] = Kegiatan::reformatTime($kegiatan['end_regis_out']);
        $data['kegiatan'] = $kegiatan;
        $data['tipePeserta'] = $tipePeserta;

        return view('absen/editKegiatan', $data);
    }

    public function update($tipePeserta, $idKegiatan)
    {
        $this->setModel($tipePeserta);
        $rules = [
            'nama-kegiatan' => [
                'rules' => 'required|max_length[64]',
                'errors' => [
                    'required' => 'Nama kegiatan wajib diisi!',
                    'max_length' => 'Nama kegiatan maksimal 64 karakter',
                ],
            ],
            'tanggal' => [
                'rules' => 'required|valid_date[d/m/Y]|date_not_passed',
                'errors' => [
                    'required' => 'Tanggal kegiatan wajib diisi!',
                    'valid_date' => 'Tanggal kegiatan tidak valid',
                    'date_not_passed' => 'Tanggal sudah lewat',
                ],
            ],
            'start-regis-in' => [
                'rules' => 'required|valid_time',
                'errors' => [
                    'required' => 'Waktu mulai regis-in wajib diisi!',
                    'valid_time' => 'Waktu mulai regis-in tidak valid',
                ],
            ],
            'end-regis-in' => [
                'rules' => 'required|valid_time|later_than[start-regis-in]',
                'errors' => [
                    'required' => 'Waktu berakhir regis-in wajib diisi!',
                    'valid_time' => 'Waktu berakhir regis-in tidak valid',
                    'later_than' => 'Waktu berakhir regis-in harus lebih akhir dari waktu mulai regis-in',
                ],
            ],
            'start-regis-out' => [
                'rules' => 'required|valid_time|later_than[start-regis-in]',
                'errors' => [
                    'required' => 'Waktu mulai regis-out wajib diisi!',
                    'valid_time' => 'Waktu mulai regis-out tidak valid',
                    'later_than' => 'Waktu mulai regis-out harus lebih akhir dari waktu mulai regis-in',
                ],
            ],
            'end-regis-out' => [
                'rules' => 'required|valid_time|later_than[start-regis-out]',
                'errors' => [
                    'required' => 'Waktu berakhir regis-out wajib diisi!',
                    'valid_time' => 'Waktu berakhir regis-out tidak valid',
                    'later_than' => 'Waktu berakhir regis-out harus lebih akhir dari waktu mulai regis-out',
                ],
            ],
        ];
        
        if (!$this->validate($rules)) 
            return redirect()->back()
                ->withInput();
        
        $isUpdateSuccess = $this->kegiatanPesertaModel->update($idKegiatan, [
            'nama' => $this->request->getPost('nama-kegiatan'),
            'tanggal' => Kegiatan::reformatDate($this->request->getPost('tanggal')),
            'start_regis_in' => $this->request->getPost('start-regis-in'),
            'end_regis_in' => $this->request->getPost('end-regis-in'),
            'start_regis_out' => $this->request->getPost('start-regis-out'),
            'end_regis_out' => $this->request->getPost('end-regis-out'),
        ]);
        
        if (!$isUpdateSuccess) 
            return redirect()->back()
                ->with('response', ['isSuccess' => false, 'message' => 'Kegiatan gagal diupdate'])
                ->withInput();
            
        return redirect()->to(site_url("panitia/absen/$tipePeserta/kegiatan"))
            ->with('response', ['isSuccess' => true, 'message' => 'Kegiatan berhasil diupdate']);
    }

    private static function reformatDate($date)
    {
        return Datetime::createFromFormat(
                'd/m/Y',
                $date
            )->format('Y-m-d');
    }

    private static function reformatTime($time)
    {
        $exploded = explode(':', $time);
        array_pop($exploded);
        return join(':', $exploded);
    }
}
