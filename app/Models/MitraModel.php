<?php

namespace App\Models;

use CodeIgniter\Model;

class MitraModel extends Model
{
    public function getMitra()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('mitra')
            ->select('*')
            ->join('village', 'mitra.village_id = village.village_id')
            ->join('district', 'village.district_id = district.district_id');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getMitraById($nip)
    {
    }
}
