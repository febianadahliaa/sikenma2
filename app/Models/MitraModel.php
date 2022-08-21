<?php

namespace App\Models;

use CodeIgniter\Model;

class MitraModel extends Model
{
    protected $table      = 'mitra';
    protected $primaryKey = 'mitra_id';
    protected $allowedFields = ['name', 'village_id', 'date_of_birth', 'gender', 'phone', 'marriage_status', 'education', 'job'];


    public function getMitraDetail()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('mitra')
            ->select('*')
            ->join('village', 'mitra.village_id = village.village_id')
            ->join('district', 'village.district_id = district.district_id');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getMitraDetailById($mitra_id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('mitra')
            ->select('*')
            ->join('village', 'mitra.village_id = village.village_id')
            ->join('district', 'village.district_id = district.district_id')
            ->where('mitra_id', $mitra_id);
        $query = $builder->get();
        return $query->getRow();
    }

    public function getVillage()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('village')->select('*')->orderBy('village', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
