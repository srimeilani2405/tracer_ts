<?php

namespace App\Controllers;

use App\Models\OrganizationModel;
use CodeIgniter\Controller;

class JurusanController extends Controller
{
    protected $organizationModel;

    public function __construct()
    {
        $this->organizationModel = new OrganizationModel();
    }

    public function index()
    {
        // Ambil semua jurusan berdasarkan tipe 'Jurusan'
        $jurusan = $this->organizationModel->where('tipe', 'Jurusan')->findAll();

        return view('jurusan/index', ['jurusan' => $jurusan]);
    }

    public function create()
    {
        // Ambil semua organisasi untuk daftar satuan induk
        $data['organizations'] = $this->organizationModel->findAll();

        return view('jurusan/create', $data);
    }

    public function store()
    {
        // Validasi input
        if (!$this->validate([
            'nama' => 'required|min_length[3]',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Nama jurusan minimal 3 karakter.');
        }

        // Simpan ke database
        $this->organizationModel->insert([
            'name' => $this->request->getPost('nama'),
            'tipe' => 'Jurusan', // Set tipe sebagai Jurusan
            'parent_id' => $this->request->getPost('satuan_induk_id'), // Bisa null jika tidak ada induk
        ]);

        return redirect()->to('/jurusan')->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Ambil data jurusan
        $jurusan = $this->organizationModel->find($id);

        if (!$jurusan) {
            return redirect()->to('/jurusan')->with('error', 'Jurusan tidak ditemukan.');
        }

        // Ambil daftar satuan induk untuk dropdown
        $data['organizations'] = $this->organizationModel->findAll();
        $data['jurusan'] = $jurusan;

        return view('jurusan/jurusan_edit', $data);
    }

    public function update($id)
    {
        // Pastikan data jurusan dengan ID ini ada di database
        $jurusan = $this->organizationModel->find($id);

        if (!$jurusan) {
            return redirect()->to('/jurusan')->with('error', 'Jurusan tidak ditemukan.');
        }

        // Validasi inputan
        $validationRules = [
            'name' => 'required|min_length[3]', // Pastikan name tidak kosong dan minimal 3 karakter
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', 'Nama jurusan harus diisi dengan minimal 3 karakter.');
        }

        // Ambil data input dari form
        $data = [
            'id' => $id, // Pastikan ID dimasukkan agar update berjalan
            'name' => $this->request->getPost('name'), // Ambil input name
        ];

        // Gunakan update() bukan insert()
        $this->organizationModel->update($id, $data);

        return redirect()->to('/jurusan')->with('success', 'Jurusan berhasil diperbarui.');
    }


    public function delete($id)
    {
        // Hapus jurusan berdasarkan ID
        if (!$this->organizationModel->find($id)) {
            return redirect()->to('/jurusan')->with('error', 'Jurusan tidak ditemukan.');
        }

        $this->organizationModel->delete($id);
        return redirect()->to('/jurusan')->with('success', 'Jurusan berhasil dihapus.');
    }

    public function tinjau($id)
    {
        // Ambil data jurusan berdasarkan ID
        $jurusan = $this->organizationModel->find($id);

        if (!$jurusan) {
            return redirect()->to('/jurusan')->with('error', 'Jurusan tidak ditemukan.');
        }

        return view('jurusan/jurusan_tinjau', ['jurusan' => $jurusan]);
    }
}
