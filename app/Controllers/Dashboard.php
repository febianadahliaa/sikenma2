<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $halaman_view = [
            'title' => 'Dashboard',
            'menuName' => 'Dashboard',
        ];
        return view('dashboard', $halaman_view);
    }
}
