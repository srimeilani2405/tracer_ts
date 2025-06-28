<?php

namespace App\Controllers;

use App\Models\SettingsModel;
use CodeIgniter\Controller;

class SettingsController extends Controller
{
    public function index()
    {
        $model = new SettingsModel();
        $data['pengaturan'] = $model->first(); // Ambil data pertama dari tabel

        return view('settings/index', $data);
    }

    public function simpan()
    {
        // Validasi input
        if (!$this->validate([
            'site_name' => 'required|min_length[3]|max_length[100]',
            'site_slogan' => 'required|min_length[3]|max_length[255]'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Nama situs dan slogan harus diisi dengan panjang yang sesuai.');
        }

        // Ambil data dari form
        $site_name = $this->request->getPost('site_name');
        $site_slogan = $this->request->getPost('site_slogan');

        // Simpan ke database
        $model = new SettingsModel();
        $model->update(1, [ // Gunakan `update()` agar tidak menimpa seluruh tabel
            'site_name' => $site_name,
            'site_slogan' => $site_slogan
        ]);

        return redirect()->to('/pengaturan')->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
