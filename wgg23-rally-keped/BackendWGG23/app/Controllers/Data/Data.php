<?php

namespace App\Controllers\Data;

use App\Controllers\BaseController;
use App\Models\Log\LogMahasiswaModel;
use App\Models\MahasiswaModel;
use App\Models\PanitiaModel;
use App\Models\RBAC\RBACRouteModel;
use App\Models\RBAC\RBACUserRoleModel;

class Data extends BaseController
{    
    private function getRoute(){
        
        //kalo punya akses semua tampilini semua route yang berkaitan data
        $routesModel = new RBACRouteModel();
        $routes = $routesModel->select("rbac_route.nama as nama_route, rbac_route.route as route")
                                ->like("rbac_route.route", "panitia/data", "after")
                                ->orderBy("rbac_route.nama")
                                ->findAll();

        return $routes;
    }
    public function index()
    {
        //
        $data['title'] = "Data";
        $data['rute'] = $this->getRoute();

        return view("data/index", $data);
    }

    public function viewMahasiswa()
    {
        $filter = $this->request->getVar();

        $mahasiswaModel = new MahasiswaModel();
        $mahasiswaModel->join('kelompok', 'mahasiswa.id_kelompok = kelompok.id', 'left');
        
        //if the view strict dont show all the data
        if(isset($filter['view']) && $filter['view'] == "strict"){
            $mahasiswaModel->select("nrp, mahasiswa.nama as nama, jenis_kelamin, prodi, kelompok.nama as kelompok");
        }else{
            $mahasiswaModel->select("nrp, mahasiswa.nama as nama, jenis_kelamin, prodi, asal_kota, agama, sma_asal, kelompok.nama as kelompok");
        }
        
        unset($filter['view']);
        
        //filter
        foreach($filter as $key => $value){
            $mahasiswaModel->where($key, $value);
        }

        $mahasiswa = $mahasiswaModel->orderBy('mahasiswa.nrp')->findAll();

        $data['mahasiswa'] = $mahasiswa;
        $data['rute'] = $this->getRoute();

        $logMahasiswaModel = new LogMahasiswaModel();
        $logMahasiswaModel->select("created_at");
        $logMahasiswaModel->orderBy('created_at', "DESC");

        $data['log'] = $logMahasiswaModel->first()['created_at'];

        $data['title'] = "Data Mahasiswa WGG 2023 " . $data['log'];

        return view("data/mahasiswa/show", $data);
    }

    public function editMahasiswa()
    {
        $mahasiswaModel = new MahasiswaModel();

        $mahasiswaModel->join('kelompok', 'mahasiswa.id_kelompok = kelompok.id', 'left');
        $mahasiswaModel->select("mahasiswa.id, nrp, mahasiswa.nama as nama, jenis_kelamin, prodi, asal_kota, agama, sma_asal, kelompok.nama as kelompok, mahasiswa.created_at, mahasiswa.updated_at, mahasiswa.deleted_at");
        $mahasiswa = $mahasiswaModel->orderBy('mahasiswa.nrp')->withDeleted()->findAll();

        $data['mahasiswa'] = $mahasiswa;
        $data['edit'] = true;
        $data['rute'] = $this->getRoute();

        $logMahasiswaModel = new LogMahasiswaModel();
        $logMahasiswaModel->select("created_at");
        $logMahasiswaModel->orderBy('created_at', "DESC");

        $data['log'] = $logMahasiswaModel->first()['created_at'];

        $data['title'] = "Data Mahasiswa WGG 2023 " . $data['log'];

        return view("data/mahasiswa/show", $data);
    }
    public function deleteMahasiswa($id)
    {
        $mahasiswaModel = new MahasiswaModel();

        if ($this->request->getMethod() == "put"){
            $mahasiswaModel->withDeleted()->update($id, [
                'deleted_at' => null
            ]);
        }else{
            $mahasiswaModel->delete($id);
        }
        
        return redirect()->back();
    }
    
    public function viewPanitia()
    {
        $filter = $this->request->getVar();

        $panitiaModel = new PanitiaModel();

        //if the view strict dont show all the data
        if(isset($filter['view']) && $filter['view'] == "strict"){
            $panitiaModel->select("nrp, nama, gender, prodi, divisi, jabatan");
        }

        unset($filter['view']);
        
        //filter
        foreach($filter as $key => $value){
            $panitiaModel->where($key, $value);
        }

        $panitia = $panitiaModel->findAll();

        $data['panitia'] = $panitia;
        $data['rute'] = $this->getRoute();

        return view("data/panitia/show", $data);
    }
    public function editPanitia()
    {
        $panitiaModel = new PanitiaModel();

        $panitia = $panitiaModel->withDeleted()->findAll();

        $data['panitia'] = $panitia;
        $data['edit'] = true;
        $data['rute'] = $this->getRoute();

        return view("data/panitia/show", $data);
    }
    public function deletePanitia($id)
    {
        $panitiaModel = new PanitiaModel();

        if ($this->request->getMethod() == "put"){
            $panitiaModel->withDeleted()->update($id, [
                'deleted_at' => null
            ]);
        }else{
            $panitiaModel->delete($id);
        }
        
        return redirect()->back();
    }
}
