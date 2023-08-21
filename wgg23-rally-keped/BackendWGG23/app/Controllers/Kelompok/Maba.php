<?php

namespace App\Controllers\Kelompok;

use App\Controllers\BaseController;
use App\Models\Kelompok\KelompokModel;
use App\Models\Kelompok\FrontlineModel;
use App\Models\Kelompok\RuanganModel;

class Maba extends BaseController
{
    public function index()
    {
        $kelompokModel = new KelompokModel();
        $frontlineModel = new FrontlineModel();
        $ruanganModel = new RuanganModel();

        // session()->set('nrp', 'C14230078');
        $nrp = session()->get('nrp');

        $data['allData'] = $kelompokModel->getData($nrp);
        $data['fl'] = $frontlineModel->getFL($nrp);
        $data['ruangan'] = $ruanganModel->getRuangan($nrp);
        $data['namaKlmpk'] = $kelompokModel->getKelompok($nrp);
        $data['ruanganHidden'] = $kelompokModel->getHiddenValue();
        $data['title'] = "Kelompok";

        return view('kelompok/kelompok_maba', $data);
    }
}
