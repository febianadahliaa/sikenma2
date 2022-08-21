<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'nip';
    protected $allowedFields = ['nip', 'name', 'email', 'password', 'role_id', 'gender', 'position_id', 'district_id', 'phone'];


    public function getUserDetail()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user')
            ->select('*')
            ->join('user_role', 'user.role_id = user_role.role_id')
            ->join('user_position', 'user.position_id = user_position.position_id')
            ->join('district', 'user.district_id = district.district_id')
            ->orderBy('nip', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getUserDetailById($nip)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user')
            ->select('*')
            ->join('user_role', 'user.role_id = user_role.role_id')
            ->join('user_position', 'user.position_id = user_position.position_id')
            ->join('district', 'user.district_id = district.district_id')
            ->where('nip', $nip);
        $query = $builder->get();
        return $query->getrow();
    }

    public function getRole()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user_role')->select('*');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getPosition()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user_position')->select('*');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getDistrict()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('district')->select('*');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
