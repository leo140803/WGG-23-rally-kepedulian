<?php

namespace App\Controllers\Briefing;

use App\Controllers\BaseController;

class Briefing extends BaseController
{
    public function index()
    {
        return view('briefing/briefing', ['title' => 'Briefing']);
    }
    
    public function web()
    {
        return view('briefing/briefing-web', ['title' => 'Briefing']);
    }
}
