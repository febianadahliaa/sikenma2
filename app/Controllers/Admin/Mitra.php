<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MitraModel;

class Mitra extends BaseController
{
    public function __construct()
    {
        $this->mitra = new MitraModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Mitra',
            'mitraList' => $this->mitra->getMitra(),
        ];
        return view('admin/mitra', $data);
    }

    public function addMitra()
    {
        if ($this->request->isAJAX()) {
            echo 'hello';
        } else {
            exit('Gagal.');
        }
    }
}
