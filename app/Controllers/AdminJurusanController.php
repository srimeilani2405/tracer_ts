<?php

namespace App\Controllers;

use App\Models\AdminJurusanModel;
use App\Models\AdminJurusanMessageModel;
use CodeIgniter\Controller;

class AdminJurusanController extends Controller
{
    protected $adminJurusanModel;

    public function __construct()
    {
        $this->adminJurusanModel = new AdminJurusanModel();
    }

    public function index()
    {
        $data['admin_jurusan'] = $this->adminJurusanModel->getAdminJurusan();
        return view('Users/admin_jurusan/index', $data);
    }

    public function dashboard()
{
    $messageModel = new AdminJurusanMessageModel();
    $message = $messageModel->first(); // Atau bisa pakai where('is_active', 1)->first() jika pakai status aktif

    return view('admin_jurusan/dashboard', ['message' => $message]);
}
    public function add()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT id, name FROM organizations WHERE parent_id IS NULL");
        $jurusan = $query->getResultArray();

        return view('Users/admin_jurusan/add', ['jurusan' => $jurusan]);
    }

    public function store()
    {
        $data = $this->request->getPost();

        // Ambil jurusan_id yang dipilih dari form
        $jurusanId = $data['jurusan_id'] ?? null;

        // Ambil nama jurusan berdasarkan ID dari tabel organizations
        $db = \Config\Database::connect();
        $jurusan = $db->table('organizations')->select('name')->where('id', $jurusanId)->get()->getRowArray();

        // Simpan data
        $this->adminJurusanModel->save([
            'nim'      => $data['nim'] ?? null,
            'username' => $data['username'],
            'email'    => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'nama'     => $data['nama'],
            'jurusan'  => $jurusan['name'] ?? null, // Ambil nama jurusan dari hasil query
            'role'     => 'admin_jurusan'
        ]);

        return redirect()->to('/admin_jurusan')->with('success', 'Data berhasil ditambahkan!');
    }


    public function edit($id)
    {
        // Load model yang menangani data jurusan/organization
        $organizationModel = new \App\Models\OrganizationModel();

        $data = [
            'adminJurusan' => $this->adminJurusanModel->find($id), // Ambil data admin jurusan berdasarkan id
            'organizations' => $organizationModel->where('parent_id', null)->findAll() // Ambil data jurusan (organisasi)
        ];

        return view('Users/admin_jurusan/edit', $data);
    }

    public function update($id)
    {
        $data = $this->request->getPost(); // Ambil data dari form

        // Jika password diisi, maka hash passwordnya
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']); // Jika tidak ada password, hapus field password dari data
        }

        // Update data pengguna berdasarkan ID
        $this->adminJurusanModel->update($id, $data);

        return redirect()->to('/admin_jurusan')->with('success', 'Data berhasil diperbarui!');
    }


    public function delete($id)
    {
        $this->adminJurusanModel->delete($id);
        return redirect()->to('/admin_jurusan')->with('success', 'Data berhasil dihapus!');
    }

    public function import()
    {
        return view('Users/admin_jurusan/import');
    }

    public function prosesImport()
    {
        $file = $this->request->getFile('file');

        if ($file->isValid() && !$file->hasMoved()) {
            $csv = fopen($file->getTempName(), 'r');
            $skipHeader = $this->request->getPost('skip_header');
            $rowNumber = 0;

            while (($row = fgetcsv($csv, 1000, ",")) !== FALSE) {
                $rowNumber++;
                if ($skipHeader && $rowNumber == 1) continue;
                if (count($row) < 4) continue;

                $data = [
                    'username' => trim($row[0]),
                    'nama'     => trim($row[1]),
                    'email'    => trim($row[2]),
                    'jurusan'  => trim($row[3]),
                    'role'     => 'admin_jurusan'
                ];

                $this->adminJurusanModel->insert($data);
            }

            fclose($csv);
            return redirect()->to('/admin_jurusan')->with('success', 'Import berhasil!');
        }

        return redirect()->to('/admin_jurusan/import')->with('error', 'File tidak valid!');
    }

    public function downloadTemplate()
    {
        $filename = "template_admin_jurusan.csv";
        $header = ["Username", "Nama", "Email", "Jurusan"];

        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $file = fopen('php://output', 'w');
        fputcsv($file, $header);
        fclose($file);
        exit;
    }
}
