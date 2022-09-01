<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class UsersModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'nip';
    protected $allowedFields = ['nip', 'name', 'email', 'password', 'role_id', 'gender', 'position_id', 'district_id', 'phone'];


    public function __construct()
    {
        parent::__construct();
        $this->db = Database::connect();
    }

    public function getUserDetail()
    {
        // $db      = Database::connect();
        $builder = $this->db->table('users')
            ->select('*')
            ->join('user_role', 'users.role_id = user_role.role_id')
            ->join('user_position', 'users.position_id = user_position.position_id')
            ->join('district', 'users.district_id = district.district_id')
            ->orderBy('nip', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getUserDetailById($nip)
    {
        $builder = $this->db->table('users')
            ->select('*')
            ->join('user_role', 'users.role_id = user_role.role_id')
            ->join('user_position', 'users.position_id = user_position.position_id')
            ->join('district', 'users.district_id = district.district_id')
            ->where('nip', $nip);
        $query = $builder->get();
        return $query->getrow();
    }

    public function getRole()
    {
        $builder = $this->db->table('user_role')->select('*');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getPosition()
    {
        $builder = $this->db->table('user_position')->select('*');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getDistrict()
    {
        $builder = $this->db->table('district')->select('*');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
