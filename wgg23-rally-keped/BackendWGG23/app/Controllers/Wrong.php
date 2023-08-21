<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Wrong extends BaseController
{
    public function index()
    {
        return view('errors/wrongDevice',['title' => 'Wrong Device']);
    }
}
