<?php

namespace App\Controllers\DataPoli;

use App\Controllers\BaseController;
use App\Models\DataPoli\PoliModel;
use CodeIgniter\I18n\Time;

class Poli extends BaseController
{

    private $model;

    public function __construct()
    {
        $this->model = new PoliModel();
    }


    //TAMPILKAN DATA
    public function index()
    {
        $data = [
            'title' => 'Absensi Poli',
            'data_absen' => $this->model
                ->tampilkan_data()
        ];


        return view('DataPoli/mainView', $data);
    }





    //TAMBAH DATA
    public function tambahdata()
    {

        $vartambah = [
            'title' => 'Regist In'
        ];

        if (isset($_POST['submit'])) {
            $validasi =  [

                'nrp' => [
                    'rules'  => 'min_length[9]|max_length[9]',
                    'errors' => [
                        'min_length' => 'NRP harus 9 karakter!',
                        'max_length' => 'NRP harus 9 karakter!'
                    ]
                ]

            ];

            //TULISAN error
            $error = false;
            $error_val = [];
            if (!$this->validate($validasi)) {
                $error = true;
                $error_val = $this->validator->getErrors();
            }

            if ($error) {
                return redirect()
                    ->to(site_url('panitia/datapoli/tambahData'))
                    ->with('error_val', $error_val)
                    ->withInput();
            }


            $checknrp = $this->model->fill_nama($this->request->getVar('nrp'));
            if (!$checknrp) {
                return redirect()
                    ->to(site_url('panitia/datapoli/tambahData'))
                    ->with('error_nrp', 'NRP tidak ada di database');
            }


            //TAMBAH DATA ke database 'Kelas'
            $date = date('Y-m-d H:i:s');
            $mytime = new Time('now');

            $this->model->tambah_data([
                'nrp' => $this->request->getVar('nrp'),
                'nama' => $this->request->getVar('nama'),
                'tanggal' => $date,
                'jam_masuk' => $mytime,
                'status' => $this->request->getVar('inputStatus'),
                'deskripsi' => $this->request->getVar('deskripsi')
            ]);


            if ($this->model->db->affectedRows() > 0) {
                return redirect()
                    ->to(site_url('panitia/datapoli/tambahData'))
                    ->with('msg_success', 'Regist in berhasil');
            } else {
                return redirect()
                    ->to(site_url('panitia/datapoli/tambahData'))
                    ->with('msg_error', 'Data gagal ditambahkan');
            }
        }



        return view('DataPoli/tambahDataView', $vartambah);
    }





    //UPDATE DATA
    public function sunting($id)
    {
        $data['title'] = 'Edit Data';
        $data['fetch_data'] = $this->model->fetch_data($id);

        //UPDATE DATA
        if ($this->request->getPost('submit') == 'ya') {

            $jammasuk = $this->request->getVar('jammasuk');
            $jamkeluar = $this->request->getVar('jamkeluar');

            if ($jamkeluar != NULL && $jamkeluar < $jammasuk) {
                return redirect()
                    ->to(site_url('panitia/datapoli/sunting/' . $id))
                    ->with('error_outpoli', 'Jam keluar poli harus lebih besar dari jam masuk');
            }


            //Update ke database
            if ($jamkeluar != NULL) {
                $update_data = $this->model->edit_data([
                    'id' => $id,
                    'deskripsi' => $this->request->getVar('deskripsi'),
                    'status' => $this->request->getVar('inputStatus'),
                    'tanggal' => $this->request->getVar('tanggal'),
                    'jam_masuk' => $this->request->getVar('jammasuk'),
                    'jam_keluar' => $this->request->getVar('jamkeluar')
                ]);
                
            }else if($jamkeluar == NULL){
                $update_data = $this->model->edit_data([
                    'id' => $id,
                    'deskripsi' => $this->request->getVar('deskripsi'),
                    'status' => $this->request->getVar('inputStatus'),
                    'tanggal' => $this->request->getVar('tanggal'),
                    'jam_masuk' => $this->request->getVar('jammasuk'),
                    'jam_keluar' => NULL
                ]);
            }


            if ($update_data) {
                return redirect()
                    ->to(site_url('panitia/datapoli/sunting/' . $id))
                    ->with('msg_success', 'Berhasil menyimpan update data');
            }

            return redirect()
                ->to(site_url('panitia/datapoli/sunting/' . $id))
                ->with('msg_error', 'Data gagal disimpan');
        }



        return view('DataPoli/sunting', $data);
    }





    //ABSENKAN KELUAR
    public function absenkeluar()
    {
        if ($this->request->getPost('absenkeluar') == 'ya') {
            $id = $this->request->getVar('id');
            $mytime = new Time('now');
            $absenkeluar = $this->model->absen_keluar($id, $mytime);

            if ($absenkeluar)
                return redirect()
                    ->to(site_url('panitia/datapoli'))
                    ->with('msg_success', 'Regist out berhasil');


            return redirect()
                ->to(site_url('panitia/datapoli/absenkeluar'))
                ->with('msg_error', 'Regist out tidak berhasil');
        }
    }





    //HAPUS DATA
    public function hapus($id)
    {
        $hapus_data = $this->model->hapus_data($id);

        if ($hapus_data)
            return redirect()
                ->to(site_url('panitia/datapoli'))
                ->with('msg_success', 'Data berhasil dihapus');

        return redirect()
            ->to(site_url('panitia/datapoli'))
            ->with('msg_error', 'Data gagal dihapus');
    }




    //FILL NAMA
    public function fillnama()
    {
        $nrp = $this->request->getVar('varianenerpe');
        $ambilnama = $this->model->fill_nama($nrp);

        if (!$ambilnama) {
            $column_ambil_nama = NULL;
        } else {
            $column_ambil_nama = $ambilnama->nama;
        }
        return $this->response
            ->setStatusCode('200')
            ->setJSON(['setnama' => $column_ambil_nama, 'csrf' => csrf_hash()]);
    }



    public function outpoli()
    {
        $data['title'] = 'Regist Out';

        if ($this->request->getPost('absenout') == 'ya') {
            $nrp = $this->request->getVar('nrp');
            $mytime = new Time('now');
            $absenkeluar = $this->model->out_poli($nrp, $mytime);

            if ($absenkeluar)
                return redirect()
                    ->to(site_url('panitia/datapoli/outpoli'))
                    ->with('msg_success', 'Regist out berhasil');


            return redirect()
                ->to(site_url('panitia/datapoli/outpoli'))
                ->with('msg_error', 'Regist out tidak berhasil');
        }

        return view('DataPoli/outPoliView', $data);
    }


    public function redirkeupdate()
    {

        if ($this->request->getPost('sunting') == 'ya') {
            $nrp = $this->request->getVar('nrp');
            $id = $this->model->redir_to_update($nrp);

            if ($id) {
                return redirect()
                    ->to(site_url('panitia/datapoli/sunting/' . $id));
            } else {
                return redirect()
                    ->to(site_url('panitia/datapoli/outpoli'));
            }
        }
    }
}
