<?php

namespace App\Controllers\Panitia;

use App\Controllers\BaseController;
use App\Models\PanitiaModel;
use App\Models\RBAC\RBACUserRoleModel;
use App\Helpers\ApiHelper;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\RequestInterface;


class Home extends BaseController
{
    private function getRoute(){

        $userRoleModel = new RBACUserRoleModel();
        $routes = $userRoleModel
            ->select("rbac_route.nama as nama_route, rbac_route.route as route")
            ->join("rbac_role", "rbac_user_role.id_role = rbac_role.id")
            ->join("rbac_role_route", "rbac_user_role.id_role = rbac_role_route.id_role")
            ->join("rbac_route", "rbac_role_route.id_route = rbac_route.id")
            ->where("rbac_user_role.deleted_at IS NULL")
            ->where("rbac_role_route.deleted_at IS NULL")
            ->groupStart()
                ->where("user", session()->get("nrp"))
                ->orWhere("user", session()->get("divisi"))
            ->groupEnd()
            ->orderBy("rbac_route.nama")
            ->findAll();

        //sort berdasarkan jumlah / dari terkecil ke besar
        usort($routes,function($a,$b){
            $jumA = preg_match_all("//",$a['route']);
            $jumB = preg_match_all("//",$b['route']);
            return $jumA <=> $jumB;
        });
            
        //hasil akhir
        $rute = [];
            
        $jumAwalRoutes = count($routes);
        for ($i=0; $i < $jumAwalRoutes; $i++) { 
            if(!array_key_exists($i, $routes)){  //check
                continue;
            }
            array_push($rute, $routes[$i]);
            $route = $routes[$i];
            for ($j=0; $j < $jumAwalRoutes; $j++) { 
                if(!array_key_exists($j, $routes)){
                    continue;
                }
                $regex = $routes[$j];
                // d($rute);
                // d($routes);
                // d($route['route'] . ' ' . $regex['route']);
                if(preg_match('~'.$route['route'].'.*~', $regex['route']) >= 1){
                    unset($routes[$j]);
                }
            }   
        }

        //sort berdasarkan nama
        usort($rute,function($a,$b){
            return $a <=> $b;
        });

        return $rute;
    }
    public function index()
    {
        $rute = $this->getRoute();
        return view('panitia/panitia_home',['rute' => $rute]);
    }

    public function photo()
    {
        $rute = $this->getRoute();

        $panitiaModel = new PanitiaModel();
        $panitia = $panitiaModel->where('nrp', session('nrp'))->first();
        
        //display uploaded foto
        $foto = $panitia['foto'] == "" ? "https://icoconvert.com/images/noimage2.png" : site_url("assets/uploads/photos/" . $panitia['foto']);
        $nama = $panitia['nama'];

        return view("panitia/upload_photo", ['rute' => $rute, 'foto' => $foto, 'nama' => $nama]);
    }
    
    public function upPhoto()
    {
        //check date (ada juga di view nya)
        if(date("Y-m-d") > "2023-05-31"){
            return redirect()->back()->with("errors", ['foto' => 'Pengumpulan foto telah ditutup']);
        }

        //validation image
        $validationRule = [
            'photo' => [
                'rules' => [
                    'uploaded[photo]',
                    'is_image[photo]',
                    'mime_in[photo,image/jpg,image/jpeg,]',
                    'max_size[photo,2048]',
                ],
            ],
            'nama' => 'required',
        ];
        if (! $this->validate($validationRule)) {
            return redirect()->back()->with("errors", $this->validator->getErrors());
        }
        
        //if validated then move image to folder
        $img = $this->request->getFile('photo');
        $namaBaru = strtoupper($this->request->getVar('nama'));

        if (! $img->hasMoved()) {
            $foldername = "../assets/uploads/photos";
            
            $filename = session('divisi') . "_" . str_replace(" ", "-", $namaBaru);
            $hash = $img->getRandomName();
            $hash = substr($hash, strpos($hash, "_"));
            
            $filename = $filename . $hash;
            $filename = strtoupper($filename);
            
            $success = $img->move($foldername, $filename);
            
            //if success move save in database
            if($success){
                $panitiaModel = new PanitiaModel();
                $panitia = $panitiaModel->where('nrp', session('nrp'))->first();
                
                $foto = $panitia['foto'];

                
                if($foto != "" && file_exists($foldername . "/" . $foto)){
                    unlink($foldername . "/" . $foto);
                }
                
                $id = $panitia['id'];
                $success = $panitiaModel->update($id, [
                    'foto' => $filename,
                    'nama' => $namaBaru
                ]);
                
                return redirect()->back()->with("success", true);
            }

            return redirect()->back()->with("errors", ["photo" => "Failed to Upload File"]);
            
        }
        
        return redirect()->back()->with("errors", ["photo" => "Something Went Wrong"]);
    }

    public function adminApp(){
        helper('ApiHelper');
        return view('panitia/admin_app', ['token' => ApiHelper::get_api_token()]);
    }
}
