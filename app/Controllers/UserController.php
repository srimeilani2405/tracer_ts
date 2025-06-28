<?php

namespace App\Controllers;

use App\Models\OrganizationModel;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $organizationModel;
    protected $userModel;

    public function __construct()
    {
        $this->organizationModel = new OrganizationModel();
        $this->userModel = new UserModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $filter = $this->request->getGet();
        $role = $filter['role'] ?? null;
        $keyword = $filter['keyword'] ?? null;
    
        $query = $this->userModel;
    
        if ($role) {
            $query = $query->where('role', $role);
        }
    
        if ($keyword) {
            $query = $query->groupStart()
                ->like('username', $keyword)
                ->orLike('email', $keyword)
                ->orLike('nama', $keyword)
                ->groupEnd();
        }
    
        $users = $query->orderBy('created_at', 'DESC')->findAll();
    
        return view('users/index', [
            'users' => $users,
            'currentRole' => $role,
            'filter' => $filter,
        ]);
    }

    public function create()
    {
        $departments = $this->organizationModel->where('parent_id', null)->findAll();
        $studyPrograms = [];
        
        if (old('jurusan')) {
            $studyPrograms = $this->organizationModel->where('parent_id', old('jurusan'))->findAll();
        }
        
        return view('users/create', [
            'departments' => $departments,
            'studyPrograms' => $studyPrograms
        ]);
    }

    public function getPrograms($jurusanId)
    {
        $programs = $this->organizationModel->where('parent_id', $jurusanId)->findAll();
        return $this->response->setJSON($programs);
    }

    public function store()
    {
        $role = $this->request->getPost('group');
        $validRoles = ['site_admin', 'admin_jurusan', 'alumni'];
        
        if (!in_array($role, $validRoles)) {
            return redirect()->back()->withInput()->with('error', 'Role tidak valid');
        }

        $rules = [
            'email' => 'required|valid_email|is_unique[users.email]',
            'username' => 'required|is_unique[users.username]',
            'password' => 'required|min_length[8]',
            'nama' => 'required',
        ];

        if ($role === 'alumni') {
            $rules['nim'] = 'required';
            $rules['angkatan'] = 'required|numeric';
            $rules['tahun_kelulusan'] = 'required|numeric';
            $rules['jenis_kelamin'] = 'required|in_list[L,P]';
            $rules['alamat1'] = 'required';
            $rules['no_hp'] = 'required';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'email' => $this->request->getPost('email'), // HAPUS esc()
            'username' => $this->request->getPost('username'), // HAPUS esc()
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $role,
            'status' => $this->request->getPost('status') === 'Aktif' ? 'active' : 'inactive',
            'nama' => $this->request->getPost('nama'), // HAPUS esc()
            'created_at' => date('Y-m-d H:i:s'),
        ];

        if (in_array($role, ['admin_jurusan', 'alumni'])) {
            $jurusanId = $this->request->getPost('jurusan');
            if ($jurusanId) {
                $jurusan = $this->organizationModel->find($jurusanId);
                $data['jurusan'] = $jurusan['name'] ?? ''; // HAPUS esc()
                $data['jurusan_id'] = $jurusanId;
            }

            $prodiId = $this->request->getPost('program_studi');
            if ($prodiId) {
                $prodi = $this->organizationModel->find($prodiId);
                $data['program_studi'] = $prodi['name'] ?? ''; // HAPUS esc()
                $data['program_studi_id'] = $prodiId;
            }
        }

        if ($role === 'alumni') {
            $jenisKelamin = $this->request->getPost('jenis_kelamin');
            $data = array_merge($data, [
                'nim' => $this->request->getPost('nim'), // HAPUS esc()
                'angkatan' => $this->request->getPost('angkatan'), // HAPUS esc()
                'tahun_kelulusan' => $this->request->getPost('tahun_kelulusan'), // HAPUS esc()
                'ipk' => $this->request->getPost('ipk') ?? 0,
                'alamat1' => $this->request->getPost('alamat1'), // HAPUS esc()
                'alamat2' => $this->request->getPost('alamat2') ?? '',
                'jenis_kelamin' => ($jenisKelamin === 'Laki-laki') ? 'L' : 'P',
                'no_hp' => $this->request->getPost('no_hp'), // HAPUS esc()
                'kota' => $this->request->getPost('kota') ?? '',
                'provinsi' => $this->request->getPost('provinsi') ?? '',
                'kodepos' => $this->request->getPost('kodepos') ?? '',
                'is_surveyor' => $this->request->getPost('is_surveyor') ? 1 : 0
            ]);
        }

        try {
            $this->userModel->insert($data);
            return redirect()->to('/users')->with('success', 'Pengguna berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan pengguna: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/users')->with('error', 'User tidak ditemukan');
        }

        $departments = $this->organizationModel->where('parent_id', null)->findAll();
        
        $studyPrograms = [];
        if (!empty($user['jurusan_id'])) {
            $studyPrograms = $this->organizationModel->where('parent_id', $user['jurusan_id'])->findAll();
        }

        return view('users/edit', [
            'user' => $user,
            'departments' => $departments,
            'studyPrograms' => $studyPrograms
        ]);
    }

    public function update($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/users')->with('error', 'User tidak ditemukan');
        }

        // Validasi dasar
        $rules = [
            'email' => "required|valid_email|is_unique[users.email,id,$id]",
            'username' => "required|is_unique[users.username,id,$id]",
            'nama' => 'required',
        ];

        // Tambahkan validasi khusus untuk alumni
        if ($this->request->getPost('role') === 'alumni') {
            $rules['nim'] = 'required';
            $rules['angkatan'] = 'required|numeric';
            $rules['tahun_kelulusan'] = 'required|numeric';
            $rules['jenis_kelamin'] = 'required|in_list[L,P]';
            $rules['alamat1'] = 'required';
            $rules['no_hp'] = 'required';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'role' => $this->request->getPost('role'),
            'status' => $this->request->getPost('status') ?? 'active',
            'nama' => $this->request->getPost('nama'),
        ];

        // Update jurusan dan program studi jika role membutuhkan
        if (in_array($this->request->getPost('role'), ['admin_jurusan', 'alumni'])) {
            $jurusanId = $this->request->getPost('jurusan');
            if ($jurusanId) {
                $jurusan = $this->organizationModel->find($jurusanId);
                $data['jurusan'] = $jurusan['name'] ?? '';
            }

            $prodiId = $this->request->getPost('program_studi');
            if ($prodiId) {
                $prodi = $this->organizationModel->find($prodiId);
                $data['program_studi'] = $prodi['name'] ?? '';
            }
        }

        // Update data khusus alumni
        if ($this->request->getPost('role') === 'alumni') {
            $data = array_merge($data, [
                'nim' => $this->request->getPost('nim'),
                'angkatan' => $this->request->getPost('angkatan'),
                'tahun_kelulusan' => $this->request->getPost('tahun_kelulusan'),
                'ipk' => $this->request->getPost('ipk') ?? 0,
                'alamat1' => $this->request->getPost('alamat1'),
                'alamat2' => $this->request->getPost('alamat2') ?? '',
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'no_hp' => $this->request->getPost('no_hp'),
                'kota' => $this->request->getPost('kota') ?? '',
                'provinsi' => $this->request->getPost('provinsi') ?? '',
                'kodepos' => $this->request->getPost('kodepos') ?? '',
                'is_surveyor' => $this->request->getPost('is_surveyor') ?? 0
            ]);
        }

        if ($password = $this->request->getPost('password')) {
            if (strlen($password) >= 8) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            } else {
                return redirect()->back()->withInput()->with('error', 'Password minimal 8 karakter');
            }
        }

        try {
            if ($this->userModel->update($id, $data)) {
                return redirect()->to('/users')->with('success', 'Data users berhasil diperbarui');
            } else {
                throw new \Exception('Gagal memperbarui data');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->userModel->delete($id);
            return redirect()->to('/users')->with('success', 'Pengguna berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->to('/users')->with('error', 'Gagal menghapus pengguna: ' . $e->getMessage());
        }
    }
}