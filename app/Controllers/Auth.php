<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class Auth extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function processLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $db = Database::connect();

        // Cek tabel admin
        $admin = $db->table('admin')->where('username', $username)->get()->getRow();
        if ($admin && password_verify($password, $admin->password)) {
            session()->set([
                'isLoggedIn' => true,
                'username' => $admin->username,
                'role' => 'admin',
            ]);
            return redirect()->to('/welcomepage');
        }

        // Cek tabel users
        $user = $db->table('users')->where('username', $username)->get()->getRow();
        if ($user && password_verify($password, $user->password)) {
            session()->set([
                'isLoggedIn'        => true,
                'user_id'           => $user->id,
                'username'          => $user->username,
                'role'              => $user->role,
                'nama'              => $user->nama,
                'nim'               => $user->nim ?? '',
                'email'             => $user->email ?? '',
                'jurusan'           => $user->jurusan ?? '',
                'program_studi'     => $user->program_studi ?? '',
                'angkatan'          => $user->angkatan ?? '',
                'no_hp'             => $user->no_hp ?? '',
                'alamat1'           => $user->alamat1 ?? '',
                'alamat2'           => $user->alamat2 ?? '',
                'kodepos'           => $user->kodepos ?? '',
                'kota'              => $user->kota ?? '',
                'provinsi'          => $user->provinsi ?? '',
                'ipk'               => $user->ipk ?? '',
                'status'            => $user->status ?? '',
                'tahun_kelulusan'   => $user->tahun_kelulusan ?? '',
                'jenis_kelamin'     => $user->jenis_kelamin ?? '',
            ]);

            // Arahkan ke halaman sesuai role
            if ($user->role == 'site_admin') {
                return redirect()->to('/welcomepage');
            } elseif ($user->role == 'admin_jurusan') {
                return redirect()->to('/admin_jurusan/dashboard');
            } elseif ($user->role == 'alumni') {
                return redirect()->to('/alumni/dashboard');
            }
        }

        // Kalau gagal login
        return redirect()->back()->with('error', 'Username atau password salah.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/tracer/home');
    }

    public function profile()
    {
        $session = session();

        // Cek apakah sudah login
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login dulu.');
        }

        $username = $session->get('username');
        $role = $session->get('role');
        $db = Database::connect();

        if ($role === 'admin') {
            $data['user'] = $db->table('admin')->where('username', $username)->get()->getRow();
        } else {
            $data['user'] = $db->table('users')->where('username', $username)->get()->getRow();
        }

        $data['role'] = $role;

        return view('profile/index', $data);
    }
}
