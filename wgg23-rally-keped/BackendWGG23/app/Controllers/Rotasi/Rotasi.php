<?php

namespace App\Controllers\Rotasi;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\rotasi\KelompokModel;
use App\Models\rotasi\RotasiModel;

class Rotasi extends BaseController
{
    protected $rotasiModel;
    protected $kelompokModel;

    protected $mhs;
    public function __construct()
    {
        $this->rotasiModel = new RotasiModel();
        $this->kelompokModel = new KelompokModel();
        $this->mhs = new MahasiswaModel();
    }


    //READ DATA
    public function view()
    {
        // Get kelompok ID
        // $kelompokId = $this->mhs->select('id_kelompok')->where('nrp',session()->get('nrp'))->first()['id_kelompok'];

        // Get data for the kelompok ID
        $pageData = [
            'title' => 'Rotasi Day-6',
            'rotasi' => $this->rotasiModel->getRotasiByKelompokId(),
        ];

        // dd($pageData);

        // Show view
        return view('rotasi/ruanganview', $pageData);
    }



    //TAMBAH DATA
    public function add_data()
    {
        if (isset($_POST['submit'])) {
            $validasi =  [
                'idKelompok' => [
                    'rules'  => 'required|unique|exist',
                    'errors' => [
                        'required' => 'kelompok harus dipilih',
                        'unique' => 'kelompok sudah ada di tabel',
                        'exist' => 'kelompok tidak ada di database'
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
                // dd($error_val);
                return redirect()
                    ->to(site_url('panitia/games/rotasi/add'))
                    ->with('error_val', $error_val)
                    ->withInput();
            }

            $hasil = $this->rotasiModel->tambah_data([
                'id_kelompok' => $this->request->getVar('idKelompok'),
                'ruang1' => $this->request->getVar('ruang1'),
                'ruang2' => $this->request->getVar('ruang2'),
                'ruang3' => $this->request->getVar('ruang3'),
                'ruang4' => $this->request->getVar('ruang4'),
                'ruang5' => $this->request->getVar('ruang5'),
                'ruang6' => $this->request->getVar('ruang6'),
                'ruang7' => $this->request->getVar('ruang7')
            ]);


            if ($hasil) {
                return redirect()
                    ->to(site_url('panitia/games/rotasi/add'))
                    ->with('msg_success', 'data berhasil ditambahkan');
            } else {
                return redirect()
                    ->to(site_url('panitia/games/rotasi/add'))
                    ->with('msg_error', 'Data gagal ditambahkan');
            }
        }

        $kelompok = $this->kelompokModel
        ->select('id,nama')
        ->where('id NOT IN (SELECT id_kelompok FROM rotasi)')
        ->findAll();

        return view('rotasi/ruanganAddview',['kelompok'=>$kelompok]);
    }



    //EDIT DATA
    public function edit_data($id)
    {
        $data['title'] = 'Edit Ruangan';
        $data['fetch_data'] = $this->rotasiModel->fetch_data($id);


        $namakelompok = $this->request->getVar('namakelompok');
        $idkelompok = $this->kelompokModel->get_id($namakelompok);


        //UPDATE DATA
        if ($this->request->getPost('submit') == 'ya') {

            $validasi =  [
                'ruang1' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'ruangan harus diisi'
                    ]
                ],
                'ruang2' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'ruangan harus diisi'
                    ]
                ],
                'ruang3' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'ruangan harus diisi'
                    ]
                ],
                'ruang4' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'ruangan harus diisi'
                    ]
                ],
                'ruang5' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'ruangan harus diisi'
                    ]
                ],
                'ruang6' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'ruangan harus diisi'
                    ]
                ],
                'ruang7' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'ruangan harus diisi'
                    ]
                ],

            ];

            // TULISAN error
            $error = false;
            $error_val = [];
            if (!$this->validate($validasi)) {
                $error = true;
                $error_val = $this->validator->getErrors();
            }


            if ($error) {
                return redirect()
                    ->to(site_url('panitia/games/rotasi/edit/' . $id))
                    ->with('error_val', $error_val)
                    ->withInput();
            }


            //Update ke database
            $update_data = $this->rotasiModel->edit_data([
                'id' => $id,
                'ruang1' => $this->request->getVar('ruang1'),
                'ruang2' => $this->request->getVar('ruang2'),
                'ruang3' => $this->request->getVar('ruang3'),
                'ruang4' => $this->request->getVar('ruang4'),
                'ruang5' => $this->request->getVar('ruang5'),
                'ruang6' => $this->request->getVar('ruang6'),
                'ruang7' => $this->request->getVar('ruang7')
            ]);


            if ($update_data) {
                return redirect()
                    ->to(site_url('panitia/games/rotasi/edit/' . $id))
                    ->with('msg_success', 'Berhasil menyimpan update data');
            }

            return redirect()
                ->to(site_url('panitia/games/rotasi/edit/' . $id))
                ->with('msg_error', 'Data gagal disimpan');
        }




        return view('rotasi/kel_editview', $data);
    }




    //HAPUS DATA
    public function delete_data($id)
    {
        $hapus_data = $this->rotasiModel->hapus_data($id);

        if ($hapus_data)
            return redirect()
                ->to(site_url('panitia/games/rotasi'))
                ->with('msg_success', 'Data berhasil dihapus');

        return redirect()
            ->to(site_url('panitia/games/rotasi'))
            ->with('msg_error', 'Data gagal dihapus');
    }
}
