<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class SurveyModel extends Model
{
    protected $table      = 'survey';
    protected $primaryKey = 'survey_id';
    protected $allowedFields = ['survey_id', 'survey_master_id', 'start_date', 'finish_date'];


    public function __construct()
    {
        parent::__construct();
        $this->db = Database::connect();
    }

    public function getSurveyDetail()
    {
        $builder = $this->db->table('survey')
            ->select('*')
            ->join('survey_master', 'survey.survey_master_id = survey_master.survey_master_id')
            ->orderBy('start_date', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getCurrentSurvey()
    {
        $builder = $this->db->table('survey')
            ->select('*')
            ->join('survey_master', 'survey.survey_master_id = survey_master.survey_master_id')
            // ->where('MONTH(start_date)', date('m'), 'MONTH(finish_date)', date('m'), 'YEAR(start_date)', date('Y'), 'YEAR(finish_date)', date('Y'));
            ->orWhere('MONTH(start_date)', date('m'), 'MONTH(finish_date)', date('m'))
            ->orWhere('YEAR(start_date)', date('Y'), 'YEAR(finish_date)', date('Y'));
        $query = $builder->get();
        return $query->getResultArray();
    }
}
