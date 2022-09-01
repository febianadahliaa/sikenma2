<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class MitraTrackRecordModel extends Model
{
    protected $table      = 'mitra_track_record';
    protected $primaryKey = 'track_record_id';
    protected $allowedFields = ['mitra_id', 'survey_id', 'year', 'geo_score', 'it_score', 'prob_score', 'qty_score', 'abc_score', 'time_score', 'user_id'];


    public function __construct()
    {
        parent::__construct();
        $this->db = Database::connect();
    }

    public function getMitraTrDetail()
    {
        $builder = $this->db->table('mitra_track_record')
            ->select('mitra_track_record.*')
            ->join('mitra', 'mitra_track_record.mitra_id = mitra.mitra_id')
            ->select('mitra.name')
            ->join('survey', 'mitra_track_record.survey_id = survey.survey_id')
            ->join('survey_master', 'survey.survey_master_id = survey_master.survey_master_id')
            ->select('survey_master.survey_master_name AS survey')
            ->join('users', 'mitra_track_record.user_id = users.nip')
            ->select('users.name AS username');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getMitraTrSummary()
    {
        $builder = $this->db->table('mitra_track_record')
            ->select('mitra_track_record.*')
            ->select('AVG(geo_score) AS geo')->groupBy('mitra_track_record.mitra_id')
            ->select('AVG(it_score) AS it')->groupBy('mitra_track_record.mitra_id')
            ->select('AVG(prob_score) AS prob')->groupBy('mitra_track_record.mitra_id')
            ->select('AVG(qty_score) AS qty')->groupBy('mitra_track_record.mitra_id')
            ->select('AVG(abc_score) AS abc')->groupBy('mitra_track_record.mitra_id')
            ->select('AVG(time_score) AS time')->groupBy('mitra_track_record.mitra_id')
            ->join('mitra', 'mitra_track_record.mitra_id = mitra.mitra_id')
            ->select('mitra.name')
            ->join('village', 'mitra.village_id = village.village_id')
            ->join('district', 'village.district_id = district.district_id')
            ->select('district.district')
            ->orderBy('mitra.name', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
