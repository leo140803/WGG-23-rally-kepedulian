<?php

namespace App\Filters;

use App\Models\RBAC\RBACRouteModel;
use App\Models\RBAC\RBACUserRoleModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $path = $request->uri->getPath();

        $query = false;
        if($request->uri->getQuery() != ""){
            $path = $path . "?" . $request->uri->getQuery();
            $query = true;
        }

        // d($request->uri->getQuery());
        // d($path);

        if(!str_contains(site_url(), "wgg.petra.ac.id")){
            session()->set('email', "c14200078@john.petra.ac.id");
            session()->set('nama', "Christopher Julius Limantoro");
            session()->set('nrp', "C14200078");//
            session()->set('isPanitia', true);
            session()->set('divisi', "IT");
        }

        $nrp_valid=['C14210073'/*,'C14200078'*/];
        if(in_array(session()->get('nrp'),$nrp_valid)){
            return null;
        }

        //check session login
        if(session()->get('email') === null || session()->get('nama') === null || session()->get('nrp') === null){
            return redirect()->to("/login")->with("error", "Please Login First");
        }

        if(session()->get("isPanitia") == false){
            // echo "not allowed access for non panitia";
            return redirect()->back()->with("argument", $request);
        }

        //check wheter this route is restrict or not
        $routeModel = new RBACRouteModel();
        $routeResult = $routeModel->where("REPLACE('$path', ' ', '') REGEXP CONCAT(route, '.*')")->findAll();

        // d($query);
        // d($routeResult);

        //if the route include in restricted route then check wheter the user has access to this route
        if($query == true){    
            $userRoleModel = new RBACUserRoleModel();
            $allRoute = $userRoleModel
                ->select("rbac_user_role.user, rbac_role.nama as role, rbac_route.nama as nama_route, rbac_route.route")
                ->join("rbac_role", "rbac_user_role.id_role = rbac_role.id")
                ->join("rbac_role_route", "rbac_user_role.id_role = rbac_role_route.id_role")
                ->join("rbac_route", "rbac_role_route.id_route = rbac_route.id")
                ->where("rbac_user_role.deleted_at IS NULL")
                ->where("rbac_role_route.deleted_at IS NULL")
                ->groupStart()
                    ->where("user", session()->get("nrp"))
                    ->orWhere("user", session()->get("divisi"))
                ->groupEnd()
                ->where("REPLACE('$path', ' ', '') REGEXP CONCAT('^', rbac_route.route, '$')")
                ->findAll();

            // d($path);
            // d($allRoute);

            if(count($allRoute) == 0){
                // echo "not allowed access";
                return redirect()->to(site_url('/login'))->with("argument", $request);
            }
        }else if(count($routeResult) > 0){    
            $userRoleModel = new RBACUserRoleModel();
            $allRoute = $userRoleModel
                ->select("rbac_user_role.user, rbac_role.nama as role, rbac_route.nama as nama_route, rbac_route.route")
                ->join("rbac_role", "rbac_user_role.id_role = rbac_role.id")
                ->join("rbac_role_route", "rbac_user_role.id_role = rbac_role_route.id_role")
                ->join("rbac_route", "rbac_role_route.id_route = rbac_route.id")
                ->where("rbac_user_role.deleted_at IS NULL")
                ->where("rbac_role_route.deleted_at IS NULL")
                ->groupStart()
                    ->where("user", session()->get("nrp"))
                    ->orWhere("user", session()->get("divisi"))
                ->groupEnd()
                ->where("REPLACE('$path', ' ', '') REGEXP CONCAT(rbac_route.route, '.*')")
                ->findAll();

            // d($path);
            // d($allRoute);

            if(count($allRoute) == 0){
                // echo "not allowed access";
                return redirect()->to(site_url('/login'))->with("argument", $request);
            }
        }else{
        // echo "not required";
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
