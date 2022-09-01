<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class SurveyMasterModel extends Model
{
    protected $table      = 'survey_master';
    protected $primaryKey = 'survey_master_id';
    protected $allowedFields = ['survey_master_id', 'survey_master_name', 'geo_score', 'it_score', 'prob_score', 'qty_score', 'abc_score', 'time_score'];


    public function __construct()
    {
        parent::__construct();
        $this->db = Database::connect();
    }

    public function getSurveyMaster()
    {
        $builder = $this->db->table('survey_master')
            ->select('*')
            ->orderBy('survey_master_name', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
