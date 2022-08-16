<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{
    protected $authModel;
    public function __construct()
    {
        $this->authModel = new AuthModel();
    }

    public function index()
    {
        // if ($email == NULL) {
        // 	$this->login();
        // } else {
        // 	if ($role == 1) {
        // 		redirect('manajemen/pegawai');
        // 	} elseif ($role == 2) {
        // 		redirect('perjadin_pegawai/list_perjadin');
        // 	} else {
        // 		redirect('perjadin_saya');
        // 	}
        // }

        return view('auth/login');
    }

    public function login()
    {
        //get data from login form
        $nip = $this->request->getPost('nip');
        $password = $this->request->getPost('password');

        $query = $this->authModel->getUser($nip);
        dd($query);

        if ($query == 0) {
            echo "no user";
        } else {
            dd($query);
        }
        // dd($query);
    }
}
