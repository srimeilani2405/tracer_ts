<?php

namespace App\Controllers;

use App\Models\OrganizationModel;
use CodeIgniter\Controller;

class ProgramStudiController extends Controller
{
    protected $organizationModel;

    public function __construct()
    {
        $this->organizationModel = new OrganizationModel();
    }

    public function index()
    {
        $data['program_studi'] = $this->organizationModel->getProgramStudiWithJurusan();
        return view('program_studi/index', $data);
    }

    public function create()
    {
        $jurusan = $this->organizationModel->where('tipe', 'Jurusan')->findAll();
        return view('program_studi/create', ['jurusan' => $jurusan]);
    }

    public function store()
    {
        $nama = $this->request->getPost('nama');
        $parent_id = $this->request->getPost('parent_id');

        if (empty($nama)) {
            return redirect()->back()->with('error', 'Nama Program Studi wajib diisi.');
        }

        $parent_id = !empty($parent_id) ? $parent_id : null;

        $this->organizationModel->insert([
            'name' => $nama,
            'tipe' => 'Program Studi',
            'parent_id' => $parent_id
        ]);

        return redirect()->to('/program_studi')->with('success', 'Program Studi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $programStudi = $this->organizationModel->find($id);
        if (!$programStudi) {
            return redirect()->to('/program_studi')->with('error', 'Program Studi tidak ditemukan.');
        }

        $jurusan = $this->organizationModel->where('tipe', 'Jurusan')->findAll();

        return view('program_studi/edit', [
            'program_studi' => $programStudi,
            'jurusan' => $jurusan
        ]);
    }

    public function update($id)
    {
        if (!$this->organizationModel->find($id)) {
            return redirect()->to('/program_studi')->with('error', 'Program Studi tidak ditemukan.');
        }

        $this->organizationModel->update($id, [
            'name' => $this->request->getPost('nama'),
            'parent_id' => $this->request->getPost('parent_id')
        ]);

        return redirect()->to('/program_studi')->with('success', 'Program Studi berhasil diperbarui.');
    }

    public function delete($id)
    {
        if (!$this->organizationModel->find($id)) {
            return redirect()->to('/program_studi')->with('error', 'Program Studi tidak ditemukan.');
        }

        $this->organizationModel->delete($id);
        return redirect()->to('/program_studi')->with('success', 'Program Studi berhasil dihapus.');
    }

    public function tinjau($id)
    {
        $data['program_studi'] = $this->organizationModel->find($id);
        if (!$data['program_studi']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('program_studi/tinjau', $data);
    }
}
