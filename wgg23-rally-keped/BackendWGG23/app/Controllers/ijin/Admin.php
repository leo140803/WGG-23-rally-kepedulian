<?php

namespace App\Controllers\Ijin;

use App\Controllers\BaseController;
use App\Models\Ijin\IjinModel;
use App\Models\Ijin\IjinTanggalModel;

class Admin extends BaseController
{
    private $ijinModel;
    private $ijinTanggalModel;
    public function __construct()
    {
        $this->ijinModel = new IjinModel();
        $this->ijinTanggalModel = new IjinTanggalModel();
    }
    private function get_tanggal_all()
    {
        $ijinTanggalAll = $this->ijinTanggalModel
        ->findAll();

        return $ijinTanggalAll;
    }
    private function get_ijin($jenis)
    {
        $ijin = $this->ijinModel
        ->select('ijin.id,ijin.nrp,nama,id_tanggal,waktu_mulai,waktu_selesai,jenis_ijin,keterangan,bukti,terima,nrp_penerima,comment,tanggal, ijin.created_at')
        ->join('mahasiswa','mahasiswa.nrp=ijin.nrp')
        ->join('ijin_tanggal','ijin.id_tanggal=ijin_tanggal.id')
        ->where('jenis_ijin', $jenis)
        ->orderBy('terima','asc')
        ->orderBy('tanggal','asc')
        ->orderBy('waktu_mulai','asc')
        ->findAll();

        return $ijin;
    }
    public function index()
    {
        $jenis = 1;      // ijin atau dispen
        if ( str_contains($this->request->getPath(), "ijin" )){
            $jenis = 2;
        }

        $ijin = $this->get_ijin($jenis);


        return view('ijin/panitia_ijin',['ijin' => $ijin]);
    }
    public function aksi()
    {
        $rules = [
            'id' => [
                'rules' => 'required|cek_id',
                'errors' => [
                    'required' => 'aksi gagal!',
                    'cek_id' => 'invalid ID!'
                ]
            ],
            'aksi' => [
                'rules' => 'required|cek_aksi',
                'errors' => [
                    'required' => 'aksi gagal!',
                    'cek_aksi' => 'invalid action!'
                ]
            ]
        ];
        $post = $this->request->getPost();
        $data = [
            "csrf" => csrf_hash(),
            "title" => 'Oops...',
            'status' => 'error',
            'message' => ''
        ];
        if(!$this->validate($rules)){
            $errors = $this->validator->getErrors();
            if(isset($errors['id'])){
                $data['message'] = $errors['id'];
            }else{
                $data['message'] = $errors['aksi'];
            }
        }else{
            if($post['comment']=='NULL' or $post['comment'] == 'undefined'){
                $proc = $this->ijinModel
                ->update($post['id'],['terima' => $post['aksi'],'nrp_penerima' => session('nrp')]);
            }else{
                $proc = $this->ijinModel
                ->update($post['id'],['terima' => $post['aksi'],'nrp_penerima' => session('nrp'), 'comment' => $post['comment']]);
            }
            if($proc){
                $data['title'] = 'Yeay!';
                $data['status'] = 'success';
                $data['message'] = 'Aksi berhasil dilakukan!';
            }
        }
        return $this->response->setJSON($data);
    }
    public function ubahIndex()
    {
        $ijinTanggal = $this->get_tanggal_all();
        return view('ijin/panitia_ubahIjin',['tanggal'=> $ijinTanggal]);
    }

    public function bukaTutup()
    {
        $rules = [
            'id' => [
                'rules' => 'required|cek_tanggalAll',
                'errors' => [
                    'required' => 'Mohon refresh dan ulang lagi!',
                    'cek_tanggal' => 'Tanggal tidak valid'
                ]
            ],
            'aksi' => [
                'rules' => 'required|cek_ubah',
                'errors' => [
                    'required' => 'Mohon refresh dan ulang lagi!',
                    'cek_aksi' => 'aksi tidka diperbolehkan!'
                ]
            ]
        ];
        $post = $this->request->getPost();
        // dd($post);
        if(!$this->validate($rules)){
            $errors = $this->validator->getErrors();
            if(isset($errors['id']))
                return redirect()->to('panitia/ijin/ubah')->with("error",$errors['id']);
            else
                return redirect()->to('panitia/ijin/ubah')->with('error',$errors['aksi']);
        }else{
            // dd($this->ijinTanggalModel->where('id',$post['id']));
            $up = $this->ijinTanggalModel
            ->update($post['id'],['open' => $post['aksi']]);
            if($up){
                if($post['aksi'] == 0)
                    return redirect()->to('panitia/ijin/ubah')->with('success','Berhasil menutup tanggal no '.$post['id']);
                else
                    return redirect()->to('panitia/ijin/ubah')->with('success','Berhasil membuka tanggal no '.$post['id']);
            }else{
                return redirect()->to('panitia/ijin/ubah')->with('error','Gagal mengupdate');
            }
        }
    }
    public function delete($del)
    {
        $delete = $this->ijinTanggalModel
        ->delete($del);

        if($delete){
            return redirect()->to('panitia/ijin/ubah')->with('success','Berhasil menghapus tanggal');
        }else{
            return redirect()->to('panitia/ijin/ubah')->with('error','Gagal menghapus tanggal');
        }
    }

    public function add()
    {
        $rules = [
            'tanggal' => [
                'rules' => 'required|cek_kembar|date_not_passed',
                'errors' => [
                    'required' => 'Tanggal harus diisi!',
                    'cek_kembar' => 'Sudah ada tanggal yang sama di data!',
                    'date_not_passed' => 'tanggal sudah lewat!'
                ]
            ]
        ];
        if(!$this->validate($rules)){
            $errors = $this->validator->getErrors();
            return redirect()->to('panitia/ijin/ubah')->with('error',$errors['tanggal']);
        }else{
            $post = $this->request->getPost();
            $adding = $this->ijinTanggalModel
            ->insert([
                'tanggal' => $post['tanggal'],
                'open' => 1
            ]);
            
            if($adding){
                return redirect()->to('panitia/ijin/ubah')->with('success','Berhasil menambahkan tanggal '.$post['tanggal']);
            }else{
                return redirect()->to('panitia/ijin/ubah')->with('error','Gagal menambahkan tanggal'.$post['tanggal']);
            }
        }
    }
}
