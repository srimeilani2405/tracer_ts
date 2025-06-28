<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ProfileController extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $user = [
            'id' => session()->get('user_id'),
            'username' => session()->get('username'),
            'email' => session()->get('email'),
            'nama' => session()->get('nama'),
            'role' => session()->get('role'),
            'last_login' => session()->get('last_login'),
            'status' => 'aktif' // asumsi aktif dari login
        ];

        return view('profile/index', ['user' => $user]);
    }

    public function edit($id)
    {
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User tidak ditemukan');
        }

        return view('profile/edit', ['user' => $user]);
    }

    public function update()
    {
        $data = $this->request->getPost();

        // Ambil ID dari form, bukan session
        $userId = $data['id'] ?? null;

        if (empty($userId)) {
            return redirect()->to('/profile')->with('error', 'ID pengguna tidak ditemukan.');
        }

        $updateData = [
            'email' => $data['email'],
            'username' => $data['username'],
            'role' => $data['role'],
            'status' => $data['status'],
            'nama' => $data['nama']
        ];

        if (!empty($data['password'])) {
            $updateData['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $userModel = new \App\Models\UserModel();

        if ($userModel->update($userId, $updateData)) {
            return redirect()->to('/profile')->with('success', 'Profil berhasil diperbarui.');
        } else {
            return redirect()->to('/profile/edit/' . $userId)->with('error', 'Gagal memperbarui profil.');
        }
    }
}
