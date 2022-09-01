<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SurveyModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->survey = new SurveyModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'menuName' => 'Dashboard',
            'currentSurveyList' => $this->survey->getCurrentSurvey(),
            'surveyDetail' => $this->survey->getSurveyDetail(),
        ];
        return view('dashboard', $data);
    }
}
