<?php

namespace App\Controllers\RBAC;

use App\Controllers\BaseController;
use App\Models\RBAC\RBACRoleModel;
use App\Models\RBAC\RBACRoleRouteModel;
use App\Models\RBAC\RBACUserRoleModel;

class Role extends BaseController
{
    public function index()
    {
        //
        $data['title'] = "Add Role";

        $roleModel = new RBACRoleModel();
        $data['roles'] = $roleModel->orderBy("nama")->findAll();
        
        return view("RBAC/addRole", $data);
    }

    public function add(){
        $nama = $this->request->getVar("nama");

        $roleModel = new RBACRoleModel();
        $role = $roleModel->where("nama", $nama)->findAll();

        if(count($role) > 0){
            return redirect()->to("panitia/rbac/addRole")->with("error", "Nama role harus unique");
        }

        $role = $roleModel->save([
            "nama" => $nama
        ]);

        if($role){
            return redirect()->to("panitia/rbac/addRole")->with("success", "Role berhasil ditambahkan");
        }else{
            return redirect()->to("panitia/rbac/addRole")->with("error", "Something Went Wrong!");
        }
    }

    public function update($id_role){
        $allCol = $this->request->getVar("col");

        $roleModel = new RBACRoleModel();

        foreach($allCol as $col => $value){
            $role = $roleModel->save(
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

    public function delete($id_role){
        //delete role
        $roleModel = new RBACRoleModel();
        $role = $roleModel->delete($id_role);

        //delete user with this role
        $userRoleModel = new RBACUserRoleModel();
        $userRole = $userRoleModel->where("id_role", $id_role)->delete();

        //delete role with its routes
        $roleRouteModel = new RBACRoleRouteModel();
        $roleRoute = $roleRouteModel->where("id_role", $id_role)->delete();

        if($role && $userRole && $roleRoute){
            return redirect()->to("panitia/rbac/addRole")->with("success", "Role berhasil dihapus");
        }else{
            return redirect()->to("panitia/rbac/addRole")->with("error", "Something Went Wrong!");
        }
    }
}
