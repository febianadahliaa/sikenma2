<?php

namespace App\Controllers\Mitra;

use App\Controllers\BaseController;
use App\Models\MitraTrackRecordModel;
use App\Models\MitraModel;
use App\Models\SurveyModel;
use App\Models\UsersModel;
use Config\Services;

class TrackRecord extends BaseController
{
    public function __construct()
    {
        $this->mitraTrackRecord = new MitraTrackRecordModel();
        $this->mitra = new MitraModel();
        $this->survey = new SurveyModel();
        $this->users = new UsersModel();
        $this->validator = Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'Entri Track Record Mitra',
            'mitraTrList' => $this->mitraTrackRecord->getMitraTrDetail(),
        ];
        return view('mitra/trackRecord', $data);
    }

    public function addMitraTr()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'mitraList' => $this->mitra->getMitraDetail(),
                'surveyList' => $this->survey->getSurveyDetail(),
                'usersList' => $this->users->getUserDetail(),
            ];
            $msg = [
                'dataAddMitraTrForm' => view('mitra/mitraTr-add-modal', $data),
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function saveMitraTr()
    {
        if ($this->request->isAJAX()) {
            $validation = $this->validator->setRules([
                'mitraId' => [
                    'label' => 'Mitra',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih.',
                    ]
                ],
                'surveyId' => [
                    'label' => 'Kegiatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih.',
                    ]
                ],
                'year' => [
                    'label' => 'Tahun',
                    'rules' => 'required|greater_than[2020]|less_than[2100]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'greater_than' => '{field} tidak valid',
                        'less_than' => '{field} tidak valid',
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
                'userId' => [
                    'label' => 'Penilai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih.',
                    ]
                ],
            ]);

            $isValid = $validation->withRequest($this->request)->run();
            if (!$isValid) {
                $msg = [
                    'error' => [
                        'mitraId' => $validation->getError('mitraId'),
                        'surveyId' => $validation->getError('surveyId'),
                        'year' => $validation->getError('year'),
                        'geoScore' => $validation->getError('geoScore'),
                        'itScore' => $validation->getError('itScore'),
                        'probScore' => $validation->getError('probScore'),
                        'qtyScore' => $validation->getError('qtyScore'),
                        'abcScore' => $validation->getError('abcScore'),
                        'timeScore' => $validation->getError('timeScore'),
                        'userId' => $validation->getError('userId'),
                    ]
                ];
            } else {
                $data = [
                    'mitra_id' => $this->request->getPost('mitraId'),
                    'survey_id' => $this->request->getPost('surveyId'),
                    'year' => $this->request->getPost('year'),
                    'geo_score' => $this->request->getPost('geoScore'),
                    'it_score' => $this->request->getPost('itScore'),
                    'prob_score' => $this->request->getPost('probScore'),
                    'qty_score' => $this->request->getPost('qtyScore'),
                    'abc_score' => $this->request->getPost('abcScore'),
                    'time_score' => $this->request->getPost('timeScore'),
                    'user_id' => $this->request->getPost('userId'),
                ];
                $this->mitraTrackRecord->insert($data);
                $msg = [
                    'successSave' => 'Data berhasil disimpan.'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function editMitraTr($track_record_id)
    {
        if ($this->request->isAJAX()) {
            $mitra_track_record = $this->mitraTrackRecord->find($track_record_id);

            $data = [
                'mitraTrId' => $mitra_track_record['track_record_id'],
                'mitraId' => $mitra_track_record['mitra_id'],
                'surveyId' => $mitra_track_record['survey_id'],
                'year' => $mitra_track_record['year'],
                'geoScore' => $mitra_track_record['geo_score'],
                'itScore' => $mitra_track_record['it_score'],
                'probScore' => $mitra_track_record['prob_score'],
                'qtyScore' => $mitra_track_record['qty_score'],
                'abcScore' => $mitra_track_record['abc_score'],
                'timeScore' => $mitra_track_record['time_score'],
                'userId' => $mitra_track_record['user_id'],
                'mitraList' => $this->mitra->getMitraDetail(),
                'surveyList' => $this->survey->getSurveyDetail(),
                'usersList' => $this->users->getUserDetail(),
            ];
            $msg = [
                'dataEditMitraTrForm' => view('mitra/mitraTr-edit-modal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function updateMitraTr()
    {
        if ($this->request->isAJAX()) {
            $validation = $this->validator->setRules([
                'mitraId' => [
                    'label' => 'Mitra',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih.',
                    ]
                ],
                'surveyId' => [
                    'label' => 'Kegiatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih.',
                    ]
                ],
                'year' => [
                    'label' => 'Tahun',
                    'rules' => 'required|greater_than[2020]|less_than[2100]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'greater_than' => '{field} tidak valid',
                        'less_than' => '{field} tidak valid',
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
                'userId' => [
                    'label' => 'Penilai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih.',
                    ]
                ],
            ]);

            $isValid = $validation->withRequest($this->request)->run();
            if (!$isValid) {
                $msg = [
                    'error' => [
                        'mitraId' => $validation->getError('mitraId'),
                        'surveyId' => $validation->getError('surveyId'),
                        'year' => $validation->getError('year'),
                        'geoScore' => $validation->getError('geoScore'),
                        'itScore' => $validation->getError('itScore'),
                        'probScore' => $validation->getError('probScore'),
                        'qtyScore' => $validation->getError('qtyScore'),
                        'abcScore' => $validation->getError('abcScore'),
                        'timeScore' => $validation->getError('timeScore'),
                        'userId' => $validation->getError('userId'),
                    ]
                ];
            } else {
                $track_record_id = $this->request->getVar('mitraTrId');
                $data = [
                    'mitra_id' => $this->request->getPost('mitraId'),
                    'survey_id' => $this->request->getPost('surveyId'),
                    'year' => $this->request->getPost('year'),
                    'geo_score' => $this->request->getPost('geoScore'),
                    'it_score' => $this->request->getPost('itScore'),
                    'prob_score' => $this->request->getPost('probScore'),
                    'qty_score' => $this->request->getPost('qtyScore'),
                    'abc_score' => $this->request->getPost('abcScore'),
                    'time_score' => $this->request->getPost('timeScore'),
                    'user_id' => $this->request->getPost('userId'),
                ];
                $this->mitraTrackRecord->update($track_record_id, $data);
                $msg = [
                    'successUpdate' => 'Data berhasil diupdate.'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function deleteMitraTr($track_record_id)
    {
        if ($this->request->isAJAX()) {
            $this->mitraTrackRecord->delete(['track_record_id' => $track_record_id]);
            $msg = [
                'successDelete' => 'Data berhasil dihapus.',
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }
}
