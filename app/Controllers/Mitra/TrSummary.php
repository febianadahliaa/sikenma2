<?php

namespace App\Controllers\Mitra;

use App\Controllers\BaseController;

class TrSummary extends BaseController
{
    public function index()
    {
        $halaman_view = [
            'title' => 'Entri Track Record Mitra',
        ];
        return view('mitra/trSummary', $halaman_view);
    }
}
