<?php

namespace App\Controllers\Kelompok;

use App\Controllers\BaseController;
use App\Models\Kelompok\FLModel;
use App\Models\Kelompok\KelompokPeranModel;
use App\Models\Kelompok\FrontlineModel;
use Exception;

use App\Models\Kelompok\KelompokModel;
use App\Models\Kelompok\MahasiswaModel;
use App\Models\Kelompok\RuanganModel;
use App\Models\Kelompok\MhModel;

class Kelompok extends BaseController
{
    private $model_kelompok;
    private $model_mahasiswa;
    private $model_frontline;

    public function __construct()
    {
     $this->model_kelompok = new KelompokPeranModel();
     $this->model_mahasiswa = new MhModel();   
     $this->model_frontline= new FLModel();   

    }

    public function index2()
    {
        $data['title'] = "List Kelompok";
        $data['data_kelompok'] = $this->model_kelompok->tampil_data();
        return view("kelompok/kelompok_home.php",$data);
    }

    public function tambah(){
        $data['title'] = "tambah kelompok";

        if(isset($_POST['sub'])){
            
     
            $validasi = [
                'nama_kelompok' => [
                    'rules' => 'required|is_unique[kelompok.nama]',
                    'errors'=> [
                        'required' => 'Nama kelompok harus di isi',
                        'is_unique'=> 'Nama kelompok telah digunakan!!'
                    ]
                ],
                'tag_mahasiswa' => [
                    'rules' => 'required',
                    'errors'=> [
                        'required' => 'Anggota harus di isi',
                    ]
                ],
                'tag_frontline' => [
                    'rules' => 'required',
                    'errors'=> [
                        'required' => 'Frontline  harus di isi',
                    ]
                ],
                'tag_ketua' => [
                    'rules' => 'required|min_length[10]',
                    'errors'=> [
                        'required' => 'Ketua harus di isi',
                        'max_length' => 'Bukan NRP',
                    ]
                ]


                
            ];

            // tambahan
            
            // tutup

            $error = false;
            $error_val = []; 
    
            if (!$this->validate($validasi))
            {
                $error = true;
                $error_val = $this->validator->getErrors();
            }
            if ($error)
            return redirect()
                ->to(site_url('panitia/kelompok/tambah'))
                ->with('error_val', $error_val)
                ->withInput();

                
            //membuat array ketua
            $dummyKetua = $this->request->getVar('tag_ketua');
            $listKetua = json_decode($dummyKetua,true); //true ini supaya jadi array
           
            
            //membuat Array Mahasiswa (karena hasil input string)
            $dummyMahasiswa = $this->request->getVar('tag_mahasiswa');
            $listMahasiswa = json_decode($dummyMahasiswa,true); //true ini supaya jadi array
          
          
            //membuat Array Frontline
            $dummyFrontline = $this->request->getVar('tag_frontline');
            $listFrontline = json_decode($dummyFrontline,true);
           
            $id_ketua = $this->model_mahasiswa->get_id($listKetua[0]['value']);
          
            // Transaction
            // $this->model_frontline->db->transStart();
try{
    $this->model_kelompok->db->transBegin();
        // membuat kelompok di table
        $this->model_kelompok->tambah_data([
            'nama' => $this->request->getVar('nama_kelompok'),
            'id_ketua'=> $id_ketua->id
            
        ]);


        $last_insertID =  $this->model_kelompok->getInsertID();
        

        // mengassign mahasiswa ke dalam kelompok
        foreach ($listMahasiswa as $v){
            $update_data = $this->model_mahasiswa->update_id_kelompok([
                'nrp' => $v['value'],
                'id_kelompok' => $last_insertID ,
          ]);

          //check jika dia merupakan seorang ketua di kelompok lain
          $id_mahasiswa =  $this->model_mahasiswa->get_id($v['value']);
          $hapusKetuaJika = $this->model_kelompok->hapus_ketua_berdasarIdKetua($id_mahasiswa->id,$last_insertID);

        }
        $update_data = $this->model_mahasiswa->update_id_kelompok([
            'nrp' =>$listKetua[0]['value'],
            'id_kelompok' => $last_insertID ,
        ]);
        $id_mahasiswa =  $this->model_mahasiswa->get_id($listKetua[0]['value']);
        $hapusKetuaJika = $this->model_kelompok->hapus_ketua_berdasarIdKetua($id_mahasiswa->id,$last_insertID);

        //mengassign kelompok Frontline
           foreach ($listFrontline as $v){
            $update_data = $this->model_frontline->update_id_kelompok([
                'nrp' => $v['value'],
                'id_kelompok' => $last_insertID ,
          ]);
        }

        
        if ($this->model_kelompok->db->transStatus() === false) {
            $this->model_kelompok->db->transRollback();
            return redirect()
                ->to(site_url('panitia/kelompok/tambah'))
                ->with('msg_exception', "Exception")
                ->withInput();
        } else {
            $this->model_kelompok->db->transCommit();
        }

        // transcation
    }catch(Exception  $e){
        $this->model_kelompok->db->transRollback();
        return redirect()
                ->to(site_url('panitia/kelompok/tambah'))
                ->with('msg_exception', "Exception")
                ->withInput();
    }

    //lanjutan
        if ($update_data){
            return redirect()
                ->to(site_url('panitia/kelompok/tambah'))
                ->with('msg_success', 'Berhasil Menambah Kelompok');
            }
  
            return redirect()
                ->to(site_url('panitia/kelompok/tambah'))
                ->with('msg_error', 'Gagal Menambah Kelompok');
        }
       
        return view('kelompok/kelompok_tambah.php',$data);
    }

    public function sunting($id){
        $data['title'] = "Update Kelompok";
        $data['data_kelompok'] = $this->model_kelompok->fetch_data($id);
        $data['data_mahasiswa'] = $this->model_mahasiswa->fetch_mahasiswa($id);
        $data['data_frontline'] = $this->model_frontline->fetch_frontline($id);
       


        //update
        //update data
        if(isset($_POST['sub'])){
            $validasi = [
                'nama_kelompok' => [
                    'rules' => 'required|is_unique[kelompok.nama]',
                    'errors'=> [
                        'required' => 'Nama kelompok harus di isi',
                        'is_unique'=> 'Nama kelompok telah digunakan!!'
                    ]
                ]

          ];


          $error = false;
          $error_val = [];
          

          if (!$this->validate($validasi))
          {
              $error = true;
              $error_val = $this->validator->getErrors();
          }

          if ($error)
              return redirect()
                  ->to(site_url('panitia/kelompok/sunting/'.$id))
                  ->with('error_val', $error_val)
                  ->withInput();
                   //updating
          $update_data = $this->model_kelompok->edit_data([
                'id' => $this->request->getVar('id'),
              'nama' => $this->request->getVar('nama_kelompok'),
          ]);

          if ($update_data){
          return redirect()
              ->to(site_url('panitia/kelompok/sunting/'.$id))
              ->with('msg_success', 'Data berhasil diubah');
          }

          return redirect()
              ->to(site_url('panitia/kelompok/sunting/'.$id))
              ->with('msg_error', 'Data gagal ditambahkan');
        }

      return view("kelompok/Kelompok_home_sunting.php",$data);
    }

    //Delete Kelompok
    public function delete(){

      
        if($this->request->getPost('sum')== 'ya'){
      

            $id_kelompok = $this->request->getVar('id_kelompok_delete');

            //mengeluarkan mahasiswa dan frontline dari kelompok
            $mahasiswaOut = $this->model_mahasiswa->kelompok_terhapus($id_kelompok);
            $frontlineOut = $this->model_frontline->kelompok_terhapus($id_kelompok);

            //delete id kelompok 
            $delete_data = $this->model_kelompok->hapus_data($id_kelompok);
    
    
            
            if ($delete_data){
                return redirect()
                    ->to(site_url('panitia/kelompok/main'))
                    ->with('msg_success', 'Kelompok berhasil dihapus');
                }
    
                return redirect()
                    ->to(site_url('panitia/kelompok/main'))
                    ->with('msg_error', 'Kelompok gagal dihapus');
                    
            
           }
            
    }   

    //keluarkan mahasiswa dr kelompok
    public function hapusKelompokMahasiswa(){
        $id_mahasiswa = $this->request->getVar('id_mahasiswa_delete');
        $hapusKelompok = $this->model_mahasiswa->hapus_kelompok_mahasiswa($id_mahasiswa); 
        
        $is_ketua = $this->request->getVar("is_ketua");
        
        $id = $this->request->getVar('id_kelompok');
        if($is_ketua == "true"){
            $hapus_ketua = $this->model_kelompok->hapus_ketua($id);
        }

        if ($hapusKelompok){
            return redirect()
                ->to(site_url('panitia/kelompok/sunting/'.$id))
                ->with('msg_success', 'Berhasil Menghapus Mahasiswa');
            }

            return redirect()
                ->to(site_url('panitia/kelompok/sunting/'.$id))
                ->with('msg_error', 'Gagal Menghapus Mahasiswa');
    }


    //keluarkan frontline dari kelompok
    public function hapusKelompokFrontline(){
        $id_frontline = $this->request->getVar('id_frontline_delete');
        $hapusKelompok = $this->model_frontline->hapus_kelompok_frontline($id_frontline); 

        $id = $this->request->getVar('id_kelompok');
        if ($hapusKelompok){
            return redirect()
                ->to(site_url('panitia/kelompok/sunting/'.$id))
                ->with('msg_success', 'Berhasil Menghapus Frontline');
            }

            return redirect()
                ->to(site_url('panitia/kelompok/sunting/'.$id))
                ->with('msg_error', 'Gagal Menghapus Frontline');
        

    }

    public function tambahAnggota(){
        $id = $this->request->getVar('id_kelompok');
        // error Checking
        $validasi = [
            'tag_mahasiswa' => [
                'rules' => 'required',
                'errors'=> [
                    'required' => 'Anggota harus di isi',
                ]
            ]

      ];
        $error = false;
        $error_val = [];

        if (!$this->validate($validasi))
        {
            $error = true;
            $error_val = $this->validator->getErrors();
        }
        if ($error)
            return redirect()
                ->to(site_url('panitia/kelompok/sunting/'.$id))
                ->with('error_val', $error_val)
                ->withInput();
         
        
        // Lanjutan : 
            //membuat Array Mahasiswa (karena hasil input string)
            $dummyMahasiswa = $this->request->getVar('tag_mahasiswa');
            $listMahasiswa = json_decode($dummyMahasiswa,true); //true ini supaya jadi array
            $id = $this->request->getVar('id_kelompok');

             // mengassign kelompok mahasiswa
            foreach ($listMahasiswa as $v){
            $update_data = $this->model_mahasiswa->update_id_kelompok([
                'nrp' => $v['value'],
                'id_kelompok' => $id ,
             ]);

             $id_mahasiswa =  $this->model_mahasiswa->get_id($v['value']);
             if ($id_mahasiswa === null) continue;
             $hapusKetuaJika = $this->model_kelompok->hapus_ketua_berdasarIdKetua($id_mahasiswa->id,$id);
            }

             if ($update_data){
                return redirect()
                    ->to(site_url('panitia/kelompok/sunting/'.$id))
                    ->with('msg_success', 'Berhasil Menambahkan Mahasiswa');
                }
    
                return redirect()
                    ->to(site_url('panitia/kelompok/sunting/'.$id))
                    ->with('msg_error', 'Gagal Menambahkan Mahasiswa');
        
    }

    public function tambahFrontline(){
        $id = $this->request->getVar('id_kelompok');
        // error Checking
        $validasi = [
            'tag_frontline' => [
                'rules' => 'required',
                'errors'=> [
                    'required' => 'Frontline  harus di isi',
                ]
            ]

      ];
        $error = false;
        $error_val = [];

        if (!$this->validate($validasi))
        {
            $error = true;
            $error_val = $this->validator->getErrors();
        }
        if ($error)
            return redirect()
                ->to(site_url('panitia/kelompok/sunting/'.$id))
                ->with('error_val', $error_val)
                ->withInput();

         //membuat Array Mahasiswa (karena hasil input string)
         $dummyFrontline = $this->request->getVar('tag_frontline');
         $listFrontline = json_decode($dummyFrontline,true); //true ini supaya jadi array
         $id = $this->request->getVar('id_kelompok');

          // mengassign kelompok mahasiswa
         foreach ($listFrontline as $v){
         $update_data = $this->model_frontline->update_id_kelompok([
             'nrp' => $v['value'],
             'id_kelompok' => $id ,
          ]);
        }

          if ($update_data){
             return redirect()
                 ->to(site_url('panitia/kelompok/sunting/'.$id))
                 ->with('msg_success', 'Berhasil Menambahkan Frontline');
             }
 
             return redirect()
                 ->to(site_url('panitia/kelompok/sunting/'.$id))
                 ->with('msg_error', 'Gagal Menambahkan Frontline');

    }

    public function setKetua(){
        $id = $this->request->getVar('id_kelompok');
        $id_mahasiswa = $this->request->getVar('id_mahasiswa');
        $update_ketua = $this->model_kelompok->set_ketua([
            'id_mahasiswa' => $id_mahasiswa,
            'id' => $id,
        ]);

        if ($update_ketua){
            return redirect()
                ->to(site_url('panitia/kelompok/sunting/'.$id))
                ->with('msg_success', 'Berhasil Set Ketua');
            }

            return redirect()
                ->to(site_url('panitia/kelompok/sunting/'.$id))
                ->with('msg_error', 'Gagal Set Ketua');

    }




    //try
    public function suggest($nrp){
        $data['suggest'] = $this->model_mahasiswa->suggestMahasiswa($nrp);
        return $this->response->setJSON($data);
    }

    public function suggestFrontline($nrp){
        $data['suggest'] = $this->model_frontline->suggestFrontline($nrp);
        return $this->response->setJSON($data);
    }


    public function myteamIndex(){
        $data['title'] = "My Team";
        $data['error'] = false;
        $id_kelompok = $this->model_frontline->get_id_kelompok(session('nrp'));
       
        if($id_kelompok == null or $id_kelompok->id_kelompok == null){
            $data['error'] = true;
             return view("kelompok/myteam.php",$data);
        }
        $data['data_kelompok'] = $this->model_kelompok->fetch_data($id_kelompok->id_kelompok);
        $data['data_mahasiswa'] = $this->model_mahasiswa->fetch_mahasiswa($id_kelompok->id_kelompok);
        $data['data_frontline'] = $this->model_frontline->fetch_frontline($id_kelompok->id_kelompok);
       
        return view("kelompok/myteam.php",$data);
    }

    public function listIndex(){
        $data['title'] = "Mahasiswa";
        $data['data_mahasiswa'] = $this->model_mahasiswa->fetch_all_mahasiswa();


        return view("kelompok/list_mahasiswa.php",$data);

    }

    public function index()
    {
        $kelompokModel = new KelompokModel();
        $ruanganModel = new RuanganModel();
        $mahasiswaModel = new MahasiswaModel();

        $data['kelompok'] = $kelompokModel->findAll();
        $data['ruangan'] = $ruanganModel->orderBy('ruangan')->findAll();
        $data['jumlah_mahasiswa'] = $mahasiswaModel->getJumlahMahasiswaPerKelompok();
        $data['ruanganHidden'] = $kelompokModel->getHiddenValue();

        return view('kelompok/tabel_kelompok', $data);
    }

    public function update()
    {
        $kelompokModel = new KelompokModel();

        $ids = $this->request->getPost('id');
        $ruangans = $this->request->getPost('ruangan');

        for ($i = 0; $i < count($ids); $i++) {
            $id = $ids[$i];
            $ruangan = $ruangans[$i];

            if ($ruangan !== '-') {
                $kelompokModel->update($id, ['ruangan' => $ruangan]);
            }
        }

        return redirect()->back()->with('success', 'Berhasil mengubah ruangan kelompok');
    }

    public function hide()
    {
        $this->hideOshow();
        return redirect()->to(site_url('panitia/kelompok/ruangan'));
    }

    private function hideOshow()
    {
        $kelompokModel = new KelompokModel();
        $hiddenValue = $kelompokModel->getHiddenValue();

        if ($hiddenValue == 1) {
            $kelompokModel->updateHiddenValue(0);
        } else {
            $kelompokModel->updateHiddenValue(1);
        }
    }

}