<?php

namespace App\Controllers\RBAC;

use App\Controllers\BaseController;
use App\Models\RBAC\RBACRoleRouteModel;
use App\Models\RBAC\RBACRouteModel;

class Route extends BaseController
{
    public function index()
    {
        //
        $data['title'] = "Add Route";

        $routeModel = new RBACRouteModel();
        $data['routes'] = $routeModel->orderBy("nama, route")->findAll();
        
        return view("RBAC/addRoute", $data);
    }

    public function add(){
        $nama = $this->request->getVar("nama");
        $route = $this->request->getVar("route");

        $routeModel = new RBACRouteModel();
        $getRoute = $routeModel->where("route", $route)->findAll();

        if(count($getRoute) > 0){
            return redirect()->to("panitia/rbac/addRoute")->with("error", "Route harus unique");
        }

        $route = $routeModel->save([
            "nama" => $nama,
            "route" => $route
        ]);

        if($route){
            return redirect()->to("panitia/rbac/addRoute")->with("success", "Route berhasil ditambahkan");
        }else{
            return redirect()->to("panitia/rbac/addRoute")->with("error", "Something Went Wrong!");
        }
    }

    public function update($id_role){
        $allCol = $this->request->getVar("col");

        $routeModel = new RBACRouteModel();

        foreach($allCol as $col => $value){
            $role = $routeModel->save(
                [
                    "id" => $id_role,
                    $col => $value
                ]
            );
        }

        $body["csrf"] = csrf_hash();

        if($role){
            $body['status'] = "ok";
            $body['msg'] = "Data berhasil diupdate";

            return $this->response->setJSON($body);
        }else{
            $body['status'] = "error";
            $body['msg'] = "Something Went Wrong";
            
            return $this->response->setJSON($body)->setStatusCode(500);
        }

    }

    public function delete($id_route){
        //delete role
        $routeModel = new RBACRouteModel();
        $route = $routeModel->delete($id_route);

        //delete role with its routes
        $roleRouteModel = new RBACRoleRouteModel();
        $roleRoute = $roleRouteModel->where("id_route", $id_route)->delete();

        if($route && $roleRoute){
            return redirect()->to("panitia/rbac/addRoute")->with("success", "Route berhasil dihapus");
        }else{
            return redirect()->to("panitia/rbac/addRoute")->with("error", "Something Went Wrong!");
        }
    }
}
