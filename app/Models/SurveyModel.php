<?php

namespace App\Models;

use CodeIgniter\Model;

class SurveyModel extends Model
{
    protected $table      = 'survey';
    protected $primaryKey = 'survey_id';
    protected $allowedFields = ['survey_id', 'survey_master_id', 'start_date', 'finish_date'];

    public function getSurveyDetail()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('survey')
            ->select('*')
            ->join('survey_master', 'survey.survey_master_id = survey_master.survey_master_id')
            ->orderBy('start_date', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
