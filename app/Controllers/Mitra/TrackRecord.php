<?php

namespace App\Controllers\Mitra;

use App\Controllers\BaseController;

class TrackRecord extends BaseController
{
    public function index()
    {
        $halaman_view = [
            'title' => 'Entri Track Record Mitra',
        ];
        return view('mitra/trackRecord', $halaman_view);
    }
}
