<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Survey extends BaseController
{
    public function index()
    {
        $halaman_view = [
            'title' => 'Daftar Kegiatan Statistik',
        ];
        return view('admin/survey', $halaman_view);
    }
}
