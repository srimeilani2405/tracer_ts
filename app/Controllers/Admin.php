<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Admin extends Controller
{
    public function index()
    {
        return redirect()->to('/welcomepage');
    }

    public function studentData()
    {
        $data = [
            'title' => 'Data Siswa/Mahasiswa',
        ];
        return view('admin/student-data', $data);
    }

    public function reports()
    {
        $data = [
            'title' => 'Laporan',
        ];
        return view('admin/reports', $data);
    }

    public function settings()
    {
        $data = [
            'title' => 'Pengaturan',
        ];
        return view('admin/settings', $data);
    }

    public function editWelcome()
    {
        $model = new \App\Models\WelcomeModel();
        $dataWelcome = $model->find(1);

        $data = [
            'title' => 'Edit Welcome',
            'welcomeMessage' => $dataWelcome['message'] ?? ''
        ];

        return view('admin/edit-welcome', $data);
    }
}
