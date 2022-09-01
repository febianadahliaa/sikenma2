<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SurveyMasterModel;
use App\Models\SurveyModel;
use Config\Services;

class Survey extends BaseController
{
    public function __construct()
    {
        $this->survey = new SurveyModel();
        $this->survey_master = new SurveyMasterModel();
        $this->validator = Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Kegiatan Statistik',
            'surveyList' => $this->survey->getSurveyDetail(),
            'surveyMasterList' => $this->survey_master->findAll(),
        ];
        return view('admin/survey', $data);
    }

    public function addSurvey()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'surveyMasterList' => $this->survey_master->getSurveyMaster(),
            ];
            $msg = [
                'dataAddSurveyForm' => view('admin/survey-add-modal', $data),
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function saveSurvey()
    {
        if ($this->request->isAJAX()) {
            $validation = $this->validator->setRules([
                'surveyMasterId' => [
                    'label' => 'Nama kegiatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih.',
                    ]
                ],
                'startDate' => [
                    'label' => 'Tanggal mulai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih.'
                    ]
                ],
                'finishDate' => [
                    'label' => 'Tanggal mulai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih.'
                    ]
                ],
            ]);

            $isValid = $validation->withRequest($this->request)->run();
            if (!$isValid) {
                $msg = [
                    'error' => [
                        'surveyMasterId' => $validation->getError('surveyMasterId'),
                        'startDate' => $validation->getError('startDate'),
                        'finishDate' => $validation->getError('finishDate'),
                    ]
                ];
            } else {
                $data = [
                    'survey_master_id' => $this->request->getPost('surveyMasterId'),
                    'start_date' => $this->request->getPost('startDate'),
                    'finish_date' => $this->request->getPost('finishDate'),
                ];
                $this->survey->insert($data);
                $msg = [
                    'successSave' => 'Data berhasil disimpan.'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function editSurvey($survey_id)
    {
        if ($this->request->isAJAX()) {
            $survey = $this->survey->find($survey_id);

            $data = [
                'surveyId' => $survey['survey_id'],
                'surveyMasterId' => $survey['survey_master_id'],
                'startDate' => $survey['start_date'],
                'finishDate' => $survey['finish_date'],
                'surveyMasterList' => $this->survey_master->getSurveyMaster(),
            ];
            $msg = [
                'dataEditSurveyForm' => view('admin/survey-edit-modal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function updateSurvey()
    {
        if ($this->request->isAJAX()) {
            $validation = $this->validator->setRules([
                'surveyMasterId' => [
                    'label' => 'Nama kegiatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih.',
                    ]
                ],
                'startDate' => [
                    'label' => 'Tanggal mulai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih.'
                    ]
                ],
                'finishDate' => [
                    'label' => 'Tanggal mulai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih.'
                    ]
                ],
            ]);

            $isValid = $validation->withRequest($this->request)->run();
            if (!$isValid) {
                $msg = [
                    'error' => [
                        'surveyMasterId' => $validation->getError('surveyMasterId'),
                        'startDate' => $validation->getError('startDate'),
                        'finishDate' => $validation->getError('finishDate'),
                    ]
                ];
            } else {
                $survey_id = $this->request->getVar('surveyId');
                $data = [
                    'survey_master_id' => $this->request->getPost('surveyMasterId'),
                    'start_date' => $this->request->getPost('startDate'),
                    'finish_date' => $this->request->getPost('finishDate'),
                ];
                $this->survey->update($survey_id, $data);
                $msg = [
                    'successUpdate' => 'Data berhasil diupdate.'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function deleteSurvey($survey_id)
    {
        if ($this->request->isAJAX()) {
            $this->survey->delete(['survey_id' => $survey_id]);
            $msg = [
                'successDelete' => 'Data berhasil dihapus.',
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function addSurveyMaster()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'surveyMasterList' => $this->survey_master->getSurveyMaster(),
            ];
            $msg = [
                'dataAddSurveyMasterForm' => view('admin/surveyMaster-add-modal', $data),
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function saveSurveyMaster()
    {
        if ($this->request->isAJAX()) {
            $validation = $this->validator->setRules([
                'surveyName' => [
                    'label' => 'Nama kegiatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                    ]
                ],
                'geoScore' => [
                    'label' => 'Nilai',
                    'rules' => 'required|greater_than[59]|less_than[96]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'greater_than' => '{field} antara 60-95',
                        'less_than' => '{field} antara 60-95',
                    ]
                ],
                'itScore' => [
                    'label' => 'Nilai',
                    'rules' => 'required|greater_than[59]|less_than[96]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'greater_than' => '{field} antara 60-95',
                        'less_than' => '{field} antara 60-95',
                    ]
                ],
                'probScore' => [
                    'label' => 'Nilai',
                    'rules' => 'required|greater_than[59]|less_than[96]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'greater_than' => '{field} antara 60-95',
                        'less_than' => '{field} antara 60-95',
                    ]
                ],
                'qtyScore' => [
                    'label' => 'Nilai',
                    'rules' => 'required|greater_than[59]|less_than[96]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'greater_than' => '{field} antara 60-95',
                        'less_than' => '{field} antara 60-95',
                    ]
                ],
                'abcScore' => [
                    'label' => 'Nilai',
                    'rules' => 'required|greater_than[59]|less_than[96]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'greater_than' => '{field} antara 60-95',
                        'less_than' => '{field} antara 60-95',
                    ]
                ],
                'timeScore' => [
                    'label' => 'Nilai',
                    'rules' => 'required|greater_than[59]|less_than[96]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'greater_than' => '{field} antara 60-95',
                        'less_than' => '{field} antara 60-95',
                    ]
                ],
            ]);

            $isValid = $validation->withRequest($this->request)->run();
            if (!$isValid) {
                $msg = [
                    'error' => [
                        'surveyName' => $validation->getError('surveyName'),
                        'geoScore' => $validation->getError('geoScore'),
                        'itScore' => $validation->getError('itScore'),
                        'probScore' => $validation->getError('probScore'),
                        'qtyScore' => $validation->getError('qtyScore'),
                        'abcScore' => $validation->getError('abcScore'),
                        'timeScore' => $validation->getError('timeScore'),
                    ]
                ];
            } else {
                $data = [
                    'survey_master_name' => $this->request->getPost('surveyName'),
                    'geo_score' => $this->request->getPost('geoScore'),
                    'it_score' => $this->request->getPost('itScore'),
                    'prob_score' => $this->request->getPost('probScore'),
                    'qty_score' => $this->request->getPost('qtyScore'),
                    'abc_score' => $this->request->getPost('abcScore'),
                    'time_score' => $this->request->getPost('timeScore'),
                ];
                $this->survey_master->insert($data);
                $msg = [
                    'successSave' => 'Data berhasil disimpan.'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function editSurveyMaster($survey_master_id)
    {
        if ($this->request->isAJAX()) {
            $survey_master = $this->survey_master->find($survey_master_id);

            $data = [
                'surveyMasterId' => $survey_master['survey_master_id'],
                'surveyName' => $survey_master['survey_master_name'],
                'geoScore' => $survey_master['geo_score'],
                'itScore' => $survey_master['it_score'],
                'probScore' => $survey_master['prob_score'],
                'qtyScore' => $survey_master['qty_score'],
                'abcScore' => $survey_master['abc_score'],
                'timeScore' => $survey_master['time_score'],
            ];
            $msg = [
                'dataEditSurveyMasterForm' => view('admin/surveyMaster-edit-modal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function updateSurveyMaster()
    {
        if ($this->request->isAJAX()) {
            $validation = $this->validator->setRules([
                'surveyName' => [
                    'label' => 'Nama kegiatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                    ]
                ],
                'geoScore' => [
                    'label' => 'Nilai',
                    'rules' => 'required|greater_than[59]|less_than[96]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'greater_than' => '{field} antara 60-95',
                        'less_than' => '{field} antara 60-95',
                    ]
                ],
                'itScore' => [
                    'label' => 'Nilai',
                    'rules' => 'required|greater_than[59]|less_than[96]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'greater_than' => '{field} antara 60-95',
                        'less_than' => '{field} antara 60-95',
                    ]
                ],
                'probScore' => [
                    'label' => 'Nilai',
                    'rules' => 'required|greater_than[59]|less_than[96]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'greater_than' => '{field} antara 60-95',
                        'less_than' => '{field} antara 60-95',
                    ]
                ],
                'qtyScore' => [
                    'label' => 'Nilai',
                    'rules' => 'required|greater_than[59]|less_than[96]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'greater_than' => '{field} antara 60-95',
                        'less_than' => '{field} antara 60-95',
                    ]
                ],
                'abcScore' => [
                    'label' => 'Nilai',
                    'rules' => 'required|greater_than[59]|less_than[96]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'greater_than' => '{field} antara 60-95',
                        'less_than' => '{field} antara 60-95',
                    ]
                ],
                'timeScore' => [
                    'label' => 'Nilai',
                    'rules' => 'required|greater_than[59]|less_than[96]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'greater_than' => '{field} antara 60-95',
                        'less_than' => '{field} antara 60-95',
                    ]
                ],
            ]);

            $isValid = $validation->withRequest($this->request)->run();
            if (!$isValid) {
                $msg = [
                    'error' => [
                        'surveyName' => $validation->getError('surveyName'),
                        'geoScore' => $validation->getError('geoScore'),
                        'itScore' => $validation->getError('itScore'),
                        'probScore' => $validation->getError('probScore'),
                        'qtyScore' => $validation->getError('qtyScore'),
                        'abcScore' => $validation->getError('abcScore'),
                        'timeScore' => $validation->getError('timeScore'),
                    ]
                ];
            } else {
                $survey_master_id = $this->request->getVar('surveyMasterId');
                $data = [
                    'survey_master_name' => $this->request->getPost('surveyName'),
                    'geo_score' => $this->request->getPost('geoScore'),
                    'it_score' => $this->request->getPost('itScore'),
                    'prob_score' => $this->request->getPost('probScore'),
                    'qty_score' => $this->request->getPost('qtyScore'),
                    'abc_score' => $this->request->getPost('abcScore'),
                    'time_score' => $this->request->getPost('timeScore'),
                ];
                $this->survey_master->update($survey_master_id, $data);
                $msg = [
                    'successUpdate' => 'Data berhasil diupdate.'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function deleteSurveyMaster($survey_master_id)
    {
        if ($this->request->isAJAX()) {
            $this->survey_master->delete(['survey_master_id' => $survey_master_id]);
            $msg = [
                'successDelete' => 'Data berhasil dihapus.',
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }
}
