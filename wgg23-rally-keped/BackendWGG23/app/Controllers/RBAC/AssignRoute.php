<?php

namespace App\Controllers\RBAC;

use App\Controllers\BaseController;
use App\Models\DivisiModel;
use App\Models\PanitiaModel;
use App\Models\RBAC\RBACRoleModel;
use App\Models\RBAC\RBACRoleRouteModel;
use App\Models\RBAC\RBACRouteModel;
use App\Models\RBAC\RBACUserRoleModel;

class AssignRoute extends BaseController
{
    public function index()
    {
        //
        $data['title'] = "Home";
        return view("RBAC/index", $data);
    }

    public function route(){
        $data['title'] = "Routes";
        
        $roleModel = new RBACRoleModel();
        $roles = $roleModel->orderBy("nama")->findAll();
        $data['roles'] = $roles;
        
        $routeModel = new RBACRouteModel();
        $route = $routeModel->orderBy('route')->findAll();
        $data['routes'] = $route;

        return view("RBAC/route", $data);
    }

    //cari role ini punya route apa aja
    public function getRoute($id_role){
        $roleRouteModel = new RBACRoleRouteModel();
        $assignRoutes = $roleRouteModel->where("id_role", $id_role)->join("rbac_route", "rbac_role_route.id_route = rbac_route.id")->orderBy("rbac_route.nama")->findAll();
        
        $data['assignRoles'] = $assignRoutes;

        return $this->response->setJSON($data);
    }

    public function setRoute($id_role){
        $response['csrf'] = csrf_hash();

        $id_route = $this->request->getVar("route");
        
        $roleRouteModel = new RBACRoleRouteModel();
        $assign = $roleRouteModel->where("id_role", $id_role)->where("id_route", $id_route)->findAll();

        
        //kalo belum ada baru ditambahin
        if(count($assign) == 0){
            $result = $roleRouteModel->save([
                "id_role" => $id_role,
                "id_route" => $id_route
            ]);

            if($result){
                $response['msg'] = "Success add route to role";
            }else{
                $response['msg'] = "Something Went Wrong";
            }
        }
        else{
            $response["msg"] = "Already assigned route to role";
            return $this->response->setJSON($response)->setStatusCode(409);
        }

        return $this->response->setJSON($response);
    }
    
    public function delRoute($id_role){
        $response['csrf'] = csrf_hash();

        $id_route = $this->request->getVar("route");

        $roleRouteModel = new RBACRoleRouteModel();
        $result = $roleRouteModel->where("id_role", $id_role)->where("id_route", $id_route)->delete();

        if($result){
            $response['msg'] = "Success delete route to role";
        }else{
            $response['msg'] = "Something Went Wrong";
        }

        return $this->response->setJSON($response);
    }
}
