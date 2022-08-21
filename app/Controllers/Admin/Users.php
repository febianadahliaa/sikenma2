<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use Config\Services;

class Users extends BaseController
{
    public function __construct()
    {
        $this->users = new UsersModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Pegawai',
            'userList' => $this->users->getUserDetail(),
            'district' => $this->users->getDistrict(),
            'role' => $this->users->getRole(),
            'position' => $this->users->getPosition(),
            'x' => $this->users->getUserDetailById('340060098'),
        ];
        // dd($data['x']);

        return view('admin/users', $data);
    }

    public function addUser()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'district' => $this->users->getDistrict(),
                'role' => $this->users->getRole(),
                'position' => $this->users->getPosition(),
            ];
            $msg = [
                'dataAddUserForm' => view('admin/user-add-modal', $data),
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function saveUser()
    {
        if ($this->request->isAJAX()) {
            $validation = Services::validation();

            $validation->setRules([
                'nip' => [
                    'label' => 'NIP pegawai',
                    'rules' => 'required|is_unique[user.nip]|min_length[9]|max_length[9]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'is_unique' => '{field} sudah ada dalam database. ',
                        'min_length' => '{field} harus terdiri dari 9 karakter. ',
                        'max_length' => '{field} harus terdiri dari 9 karakter. ',
                    ]
                ],
                'name' => [
                    'label' => 'Nama pegawai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                    ]
                ],
                'district_id' => [
                    'label' => 'Wilayah pegawai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih.',
                    ]
                ],
                'position_id' => [
                    'label' => 'Jabatan pegawai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih.',
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'valid_email' => '{field} tidak valid.',
                    ]
                ],
                'phone' => [
                    'label' => 'Nomor HP',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                    ]
                ],
                'role_id' => [
                    'label' => 'Role pegawai',
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
                        'nip' => $validation->getError('nip'),
                        'name' => $validation->getError('name'),
                        'district_id' => $validation->getError('district_id'),
                        'position_id' => $validation->getError('position_id'),
                        'email' => $validation->getError('email'),
                        'phone' => $validation->getError('phone'),
                        'role_id' => $validation->getError('role_id'),
                    ]
                ];
            } else {
                $data = [
                    'nip' => $this->request->getPost('nip'),
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    // 'name' => htmlspecialchars($this->request->getPost('name', true)),
                    // 'email' => htmlspecialchars($this->request->getPost('email', true)),
                    'password' => password_hash('123456', PASSWORD_DEFAULT),
                    'role_id' => $this->request->getPost('role_id'),
                    'gender' => $this->request->getPost('gender'),
                    'position_id' => $this->request->getPost('position_id'),
                    'district_id' => $this->request->getPost('district_id'),
                    'phone' => $this->request->getPost('phone'),
                ];
                $this->users->insert($data);
                $msg = [
                    'successSave' => 'Data berhasil disimpan.'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function userDetail($nip)
    {
        if ($this->request->isAJAX()) {
            $data = [
                'userDetail' => $this->users->getUserDetailById($nip),
            ];
            $msg = [
                'dataUserDetailForm' => view('admin/user-detail-modal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function editUser($nip)
    {
        if ($this->request->isAJAX()) {
            $users = $this->users->find($nip);

            $data = [
                'nip' => $users['nip'],
                'name' => $users['name'],
                'email' => $users['email'],
                'role_id' => $users['role_id'],
                'gender' => $users['gender'],
                'position_id' => $users['position_id'],
                'district_id' => $users['district_id'],
                'phone' => $users['phone'],
                'district' => $this->users->getDistrict(),
                'role' => $this->users->getRole(),
                'position' => $this->users->getPosition(),
            ];
            $msg = [
                'dataEditUserForm' => view('admin/user-edit-modal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function updateUser()
    {
        if ($this->request->isAJAX()) {
            $validation = Services::validation();

            $validation->setRules([
                'name' => [
                    'label' => 'Nama pegawai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                    ]
                ],
                'district_id' => [
                    'label' => 'Wilayah pegawai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih.',
                    ]
                ],
                'position_id' => [
                    'label' => 'Jabatan pegawai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih.',
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'valid_email' => '{field} tidak valid.',
                    ]
                ],
                'phone' => [
                    'label' => 'Nomor HP',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                    ]
                ],
                'role_id' => [
                    'label' => 'Role pegawai',
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
                        'name' => $validation->getError('name'),
                        'district_id' => $validation->getError('district_id'),
                        'position_id' => $validation->getError('position_id'),
                        'email' => $validation->getError('email'),
                        'phone' => $validation->getError('phone'),
                        'role_id' => $validation->getError('role_id'),
                    ]
                ];
            } else {
                $nip = $this->request->getVar('nip');
                $data = [
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'role_id' => $this->request->getPost('role_id'),
                    'gender' => $this->request->getPost('gender'),
                    'position_id' => $this->request->getPost('position_id'),
                    'district_id' => $this->request->getPost('district_id'),
                    'phone' => $this->request->getPost('phone'),
                ];
                $this->users->update($nip, $data);
                $msg = [
                    'successSave' => 'Data berhasil disimpan.'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function resetPassword($nip)
    {
        if ($this->request->isAJAX()) {
            $this->users->find($nip);
            $data = [
                'password' => password_hash('123456', PASSWORD_DEFAULT),
            ];
            $this->users->update($nip, $data);
            $msg = [
                'successResetPassword' => 'Password berhasil direset. Password saat ini adalah 123456. Segera ganti password pada menu Profile.',
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }

    public function deleteUser($nip)
    {
        if ($this->request->isAJAX()) {
            $this->users->delete(['nip' => $nip]);
            $msg = [
                'successDelete' => 'Data berhasil dihapus.',
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses.');
        }
    }
}
