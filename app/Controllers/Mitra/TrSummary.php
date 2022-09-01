<?php

namespace App\Controllers\Mitra;

use App\Controllers\BaseController;
use App\Models\MitraTrackRecordModel;

class TrSummary extends BaseController
{
    public function __construct()
    {
        $this->mitraTrackRecord = new MitraTrackRecordModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Entri Track Record Mitra',
            'mitraTrSummary' => $this->mitraTrackRecord->getMitraTrSummary(),
        ];
        return view('mitra/trSummary', $data);
    }
}
