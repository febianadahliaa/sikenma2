<?php

namespace App\Models;

use CodeIgniter\Model;

class SurveyModel extends Model
{
    public function getUser($nip)
    {
        // $data = $this->authModel->findAll();
        // dd($data);

        // $query = $this->db->get_where('user', ['email' => $this->session->userdata('email')]);
        // return $query->row_array();


        return $this->where(['nip' => $nip])->first();
    }

    // $query = $this->db->get_where('user', ['email' => $this->session->userdata('email')]);
    //     return $query->row_array();
}
