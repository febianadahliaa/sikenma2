<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MitraModel;
use Config\Services;

class Mitra extends BaseController
{
    public function __construct()
    {
        $this->mitra = new MitraModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Mitra',
            'mitraList' => $this->mitra->getMitraDetail(),
        ];
        return view('admin/mitra', $data);
    }

    public function addMitra()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'village' => $this->mitra->getVillage(),
            ];
            $msg = [
                'dataAddMitraForm' => view('admin/mitra-add-modal', $data),
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function saveMitra()
    {
        if ($this->request->isAJAX()) {
            $validation = Services::validation();

            $validation->setRules([
                'name' => [
                    'label' => 'Nama mitra',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                    ]
                ], //name dari input
                'village_id' => [
                    'label' => 'Desa asal mitra',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih.',
                    ]
                ],
                'birthdate' => [
                    'label' => 'Tanggal lahir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                    ]
                ],
                'phone' => [
                    'label' => 'Nomor HP',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                    ]
                ],
                'education' => [
                    'label' => 'Pendidikan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih.',
                    ]
                ],
                'job' => [
                    'label' => 'Pekerjaan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                    ]
                ],
            ]);

            $isValid = $validation->withRequest($this->request)->run();
            if (!$isValid) {
                $msg = [
                    'error' => [
                        'name' => $validation->getError('name'),
                        'village_id' => $validation->getError('village_id'),
                        'birthdate' => $validation->getError('birthdate'),
                        'gender' => $validation->getError('gender'),
                        'phone' => $validation->getError('phone'),
                        'marriage' => $validation->getError('marriage'),
                        'education' => $validation->getError('education'),
                        'job' => $validation->getError('job'),
                    ]
                ];
            } else {
                $data = [
                    'name' => $this->request->getPost('name'),
                    'village_id' => $this->request->getPost('village_id'),
                    'date_of_birth' => $this->request->getPost('birthdate'),
                    'gender' => $this->request->getPost('gender'),
                    'phone' => $this->request->getPost('phone'),
                    'marriage_status' => $this->request->getPost('marriage'),
                    'education' => $this->request->getPost('education'),
                    'job' => $this->request->getPost('job'),
                ];
                $this->mitra->insert($data);
                $msg = [
                    'successSave' => 'Data berhasil disimpan.'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function mitraDetail($mitra_id)
    {
        if ($this->request->isAJAX()) {
            $data = [
                'mitraDetail' => $this->mitra->getMitraDetailById($mitra_id),
            ];
            $msg = [
                'dataMitraDetailForm' => view('admin/mitra-detail-modal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function editMitra($mitra_id)
    {
        if ($this->request->isAJAX()) {
            // $mitra_id = $this->request->getVar('mitra_id');
            $mitra = $this->mitra->find($mitra_id);

            $data = [
                'id' => $mitra['mitra_id'],
                'name' => $mitra['name'],
                'village_id' => $mitra['village_id'],
                'birthdate' => $mitra['date_of_birth'],
                'gender' => $mitra['gender'],
                'phone' => $mitra['phone'],
                'marriage' => $mitra['marriage_status'],
                'education' => $mitra['education'],
                'job' => $mitra['job'],
                'village' => $this->mitra->getVillage(),
            ];
            $msg = [
                'dataEditMitraForm' => view('admin/mitra-edit-modal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function updateMitra()
    {
        if ($this->request->isAJAX()) {
            $validation = Services::validation();

            $validation->setRules([
                'name' => [
                    'label' => 'Nama mitra',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                    ]
                ],
                'village_id' => [
                    'label' => 'Desa asal mitra',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih.',
                    ]
                ],
                'birthdate' => [
                    'label' => 'Tanggal lahir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                    ]
                ],
                'phone' => [
                    'label' => 'Nomor HP',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                    ]
                ],
                'education' => [
                    'label' => 'Pendidikan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih.',
                    ]
                ],
                'job' => [
                    'label' => 'Pekerjaan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                    ]
                ],
            ]);

            $isValid = $validation->withRequest($this->request)->run();
            if (!$isValid) {
                $msg = [
                    'error' => [
                        'name' => $validation->getError('name'),
                        'village_id' => $validation->getError('village_id'),
                        'birthdate' => $validation->getError('birthdate'),
                        'gender' => $validation->getError('gender'),
                        'phone' => $validation->getError('phone'),
                        'marriage' => $validation->getError('marriage'),
                        'education' => $validation->getError('education'),
                        'job' => $validation->getError('job'),
                    ]
                ];
            } else {
                $mitra_id = $this->request->getVar('id');
                $data = [
                    'name' => $this->request->getPost('name'),
                    'village_id' => $this->request->getPost('village_id'),
                    'date_of_birth' => $this->request->getPost('birthdate'),
                    'gender' => $this->request->getPost('gender'),
                    'phone' => $this->request->getPost('phone'),
                    'marriage_status' => $this->request->getPost('marriage'),
                    'education' => $this->request->getPost('education'),
                    'job' => $this->request->getPost('job'),
                ];
                $this->mitra->update($mitra_id, $data);
                $msg = [
                    'successUpdate' => 'Data berhasil diupdate.'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function deleteMitra($mitra_id)
    {
        if ($this->request->isAJAX()) {
            $this->mitra->delete(['mitra_id' => $mitra_id]);
            $msg = [
                'successDelete' => 'Data berhasil dihapus.',
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }
}
