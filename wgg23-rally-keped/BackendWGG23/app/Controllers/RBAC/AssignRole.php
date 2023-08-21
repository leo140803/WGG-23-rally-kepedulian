<?php

namespace App\Controllers\RBAC;

use App\Controllers\BaseController;
use App\Models\DivisiModel;
use App\Models\PanitiaModel;
use App\Models\RBAC\RBACRoleModel;
use App\Models\RBAC\RBACUserRoleModel;
use CodeIgniter\HTTP\Response;

class AssignRole extends BaseController
{
    public function index()
    {
        //
        $data['title'] = "Home";
        return view("RBAC/index", $data);
    }

    public function role(){
        $data['title'] = "Roles";

        $divisiModel = new DivisiModel();
        $usersDivisi = $divisiModel->select("divisi as user, divisi as nrp, divisi")->findAll();
        
        $panitiaModel = new PanitiaModel();
        $usersPanitia = $panitiaModel->select("CONCAT(nrp, ' - ' , nama) as user, nrp, divisi")->findAll();
        
        $data['users'] = array_merge($usersDivisi, $usersPanitia);

        // dd($data['users']);

        $roleModel = new RBACRoleModel();
        $roles = $roleModel->orderBy("nama")->findAll();
        $data['roles'] = $roles;

        return view("RBAC/role", $data);
    }

    public function getRole($user){
        $userRoleModel = new RBACUserRoleModel();
        $assignRoles = $userRoleModel->where("user", $user)->join("rbac_role", "rbac_user_role.id_role = rbac_role.id")->orderBy("rbac_role.nama")->findAll();

        $roleModel = new RBACRoleModel();
        $unassignRoles = $roleModel->where("`id` NOT IN (SELECT `id` FROM `rbac_user_role` WHERE `rbac_user_role`.`user` = '$user' AND `rbac_user_role`.`deleted_at` IS NULL)", null, false)->orderBy("rbac_role.nama")->findAll();
        // $unassignRoles = $userRoleModel->where("user", $user)->join("rbac_role", "rbac_user_role.id_role = rbac_role.id", "right")->where("rbac_user_role.user IS NULL")->orderBy("rbac_role.nama")->findAll();
        
        $data['assignRoles'] = $assignRoles;
        $data['unassignRoles'] = $unassignRoles;

        return $this->response->setJSON($data);
    }

    public function setRole($user){
        $response['csrf'] = csrf_hash();

        $id_role = $this->request->getVar("role");

        $panitiaModel = new PanitiaModel();
        $panitia = $panitiaModel->where("nrp", $user)->findAll();

        $divisiModel = new DivisiModel();
        $divisi = $divisiModel->where("divisi", $user)->findAll();
        
        $userRoleModel = new RBACUserRoleModel();
        $assign = $userRoleModel->where("user", $user)->where("id_role", $id_role)->findAll();

        //check user, nrp panitia atau divisi bukan
        if((strlen($user) == 9 && count($panitia) > 0) || count($divisi) > 0){  //kalo terpenuhi baru bikin
            //kalo belum ada baru ditambahin
            if(count($assign) == 0){
                $result = $userRoleModel->save([
                    "user" => $user,
                    "id_role" => $id_role
                ]);

                if($result){
                    $response['msg'] = "Success add role to user";
                }else{
                    $response['msg'] = "Something Went Wrong";
                }
            }
        }else{
            $response["msg"] = "Unallowed User";
            return $this->response->setJSON($response)->setStatusCode(401);
        }

        return $this->response->setJSON($response);
    }
    
    public function delRole($user){
        $response['csrf'] = csrf_hash();

        $id_role = $this->request->getVar("role");

        $userRoleModel = new RBACUserRoleModel();
        $result = $userRoleModel->where("user", $user)->where("id_role", $id_role)->delete();

        if($result){
            $response['msg'] = "Success delete role to user";
        }else{
            $response['msg'] = "Something Went Wrong";
        }

        return $this->response->setJSON($response);
    }
    
    public function route(){
        $data['title'] = "routes";
        return view("RBAC/route", $data);
    }
}
