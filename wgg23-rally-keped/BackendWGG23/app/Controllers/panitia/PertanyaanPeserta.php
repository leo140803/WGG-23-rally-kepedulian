<?php

namespace App\Controllers\Panitia;

use App\Controllers\BaseController;
use App\Models\QnA\PertanyaanModel;
use App\Models\QnA\PertanyaanPengaturanModel;
use App\Models\RBAC\RBACUserRoleModel;

class PertanyaanPeserta extends BaseController
{

    // Pertanyaan Talkshow
    public function index()
    {
        $data['title'] = 'Pertanyaan Talkshow';
        $data['rute'] = $this->getRoute();

        $model = new PertanyaanModel;
        $pengaturan = new PertanyaanPengaturanModel;

        $data['is_open_qna'] = $pengaturan
        ->select('is_open')
        ->where('id', 1)
        ->first();

        if ($this->request->getGet('act') == 'switch')
        {
            // Cek Pengaturan
            if (!$data['is_open_qna'])
            {
                $pengaturan->insert([
                    'id' => 1,
                    'last_changed_nrp' => session()->get('nrp'),
                    'is_open' => 1
                ]);
            }
            else
            {
                $is_open = $data['is_open_qna']->is_open == 0 ? 1 : 0;

                $pengaturan->set('is_open', $is_open)
                ->where('id', 1)
                ->update();
            }

            return redirect()->to(site_url('panitia/qna-peserta'));
        }

        $data['data_pertanyaan'] = $model
        ->select('m.nrp, m.nama, pertanyaan, talkshow_pertanyaan.created_at, is_anonym')
        ->join('mahasiswa m', 'm.nrp = talkshow_pertanyaan.nrp', 'inner')
        ->orderBy('talkshow_pertanyaan.created_at', 'ASC')
        ->findAll();

        $is_allowed_div = ['it', 'acara'];

        $data['allowed_div'] = in_array(strtolower(session()->get('divisi')), $is_allowed_div);

        return view('QnA/pertanyaan_panitia', $data);
    }

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
}
