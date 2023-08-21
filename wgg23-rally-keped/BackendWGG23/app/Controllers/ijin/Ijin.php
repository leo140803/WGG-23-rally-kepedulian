<?php

namespace App\Controllers\Ijin;

use App\Controllers\BaseController;
use App\Models\Ijin\IjinModel;
use App\Models\Ijin\IjinTanggalModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MahasiswaModel;

class Ijin extends BaseController
{
    private $ijinTanggalModel;
    private $ijinModel;
    private $mhs;
    public function __construct()
    {
        $this->ijinTanggalModel = new IjinTanggalModel();
        $this->ijinModel = new IjinModel();
        $this->mhs = new MahasiswaModel();
    }
    private function get_tanggal()
    {
        $ijinTanggal = $this->ijinTanggalModel
        ->where('open',1)
        ->findAll();

        return $ijinTanggal;
    }
    private function get_tanggal_all()
    {
        $ijinTanggalAll = $this->ijinTanggalModel
        ->findAll();

        return $ijinTanggalAll;
    }
    private function get_ijin()
    {
        $ijin = $this->ijinModel
        ->join('ijin_tanggal','ijin.id_tanggal=ijin_tanggal.id')
        ->where('nrp',session('nrp'))
        ->findAll();
        return $ijin;
    }
    public function index()
    {
        $ijin = $this->get_ijin();
        return view('ijin/peserta_ijin',['ijin' => $ijin, 'title' => 'Izin']);
    }
    
    public function insertIndex()
    {
        $tanggal = $this->get_tanggal();
        return view('ijin/peserta_insertIjin',['tanggal' => $tanggal, 'title' => 'Izin']);
    }
    public function insert()
    {
        $rules = [
            'tanggal' => [
                'rules' => 'required|cek_tanggal',
                'errors' => [
                    'required' => 'Tanggal masih kosong!',
                    'cek_tanggal' => 'Tanggal tidak valid!'
                ]
            ],
            'jenis' => [
                'rules' => 'required|cek_jenis',
                'errors' => [
                    'required' => 'Jenis masih kosong!',
                    'cek_jenis' => 'Jenis tidak valid!'
                ]
            ],
            'start-izin' => [
                'rules' => 'required|valid_time|time_not_passed[start-izin]',
                'errors' => [
                    'required' => 'waktu awal ijin masih kosong!',
                    'valid_time' => 'waktu awal tidak valid',
                    'time_not_passed' => 'waktu awal sudah lewat'
                ]
            ],
            'end-izin' => [
                'rules' => 'required|valid_time|later_than[start-izin]|time_not_passed[end-izin]',
                'errors' => [
                    'required' => 'waktu akhir ijin masih kosong!',
                    'valid_time' => 'waktu akhir tidak valid',
                    'later_than' => 'waktu akhir kurang dari waktu awal',
                    'time_not_passed' => 'waktu akhir sudah lewat'
                ]
            ],
            'alasan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'alasan masih kosong!'
                ]
            ],
            'bukti' => [
                'rules' => 'uploaded[bukti]|mime_in[bukti,application/pdf]|ext_in[bukti,pdf]|max_size[bukti,2048]',
                'errors' => [
                    'uploaded' => 'Bukti masih kosong!',
                    'mime_in' => 'Hanya menerima file PDF',
                    'ext_in' => 'Hanya menerima file PDF',
                    'max_size' => 'Hanya menerima maksimal 2MB'
                ]
            ]    
        ];
        
        $post = $this->request->getPost();
        $data = [
            "title" => 'Oopss...',
            "status" => 'error',
            "message" => '',
            "csrf" => csrf_hash()
        ];
        
        if(!$this->validate($rules)){
            $errors = $this->validator->getErrors();
            // return $this->response->setJSON($errors);
            if(isset($errors['tanggal'])){
                $data['message'] = $errors['tanggal'];
            }else if(isset($errors['jenis'])){
                $data['message'] = $errors['jenis'];
            }else if(isset($errors['start-izin'])){
                $data['message'] = $errors['start-izin'];
            }else if(isset($errors['end-izin'])){
                $data['message'] = $errors['end-izin'];
            }else if(isset($errors['alasan'])){
                $data['message'] = $errors['alasan'];
            }else if(isset($errors['bukti'])){
                $data['message'] = $errors['bukti'];
            }
        }else{
            $file = $this->request->getFile('bukti');
            $folder = '../assets/uploads/buktiIjin/';
            $tanggalIjin = $this->ijinTanggalModel
            ->select('tanggal')
            ->where('id',$post['tanggal'])
            ->first()['tanggal'];
            $nrp = session('nrp');
            if($this->mhs->where('nrp',$nrp)->first() == null){
                $data['message'] = 'NRP tidak ditemukan, mohon login ulang!';
                return $this->response
                ->setJSON($data);
            }

            $hash = $file->getRandomName();
            $hash = substr($hash,strpos($hash,'_'));
            $fileName = $nrp.'_'.$tanggalIjin.'_'.$post['start-izin'].'_'.$post['end-izin'].$hash;
            $fileName = str_replace(":","",$fileName);
            $succ = $file->move($folder,$fileName);
            if($succ){
                $proc = $this->ijinModel
                ->insert([
                    'nrp' => $nrp,
                    'id_tanggal' => $post['tanggal'],
                    'waktu_mulai' => $post['start-izin'].':00',
                    'waktu_selesai' => $post['end-izin'].':00',
                    'jenis_ijin' => $post['jenis'],
                    'keterangan' => $post['alasan'],
                    'bukti' => $fileName,
                    'terima' => 0
                ]);
                if($proc){
                    $data['title'] = 'Yeay...';
                    $data['status'] = 'success';
                    $data['message'] = 'Ijin berhasil diajukan mohon tunggu!';
                }else{
                    $data['message'] = 'Insert Ijin Gagal, mohon ulangi lagi!';
                }
            }else{
                $data['message'] = 'File gagal di upload, mohon ulangi lagi!';
            }
        }
        return $this->response
            ->setJSON($data);
    }
    function cek_tanggal($cek){
        $tanggal = $this->get_tanggal();
        return in_array($cek,$tanggal);
    }
}
