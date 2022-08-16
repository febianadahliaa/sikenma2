<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Employee extends BaseController
{
    public function index()
    {
        $halaman_view = [
            'title' => 'Daftar Pegawai',
            'menuName' => 'Manajamen',
            'subMenuName' => 'Employee'
        ];
        return view('admin/employee', $halaman_view);
    }
}
