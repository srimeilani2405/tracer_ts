<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\SiteAdminModel;
use CodeIgniter\Controller;
use App\Models\OrganizationModel;

class SiteAdminController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data['site_admin'] = $this->userModel->where('role', 'site_admin')->findAll();
        return view('Users/site_admin/index', $data);
    }

    public function add()
    {
        $organizationModel = new OrganizationModel();

        // Ambil semua jurusan (misalnya tipe 1 itu jurusan)
        $jurusan = $organizationModel->where('parent_id', null)->findAll();

        return view('Users/site_admin/add', [
            'jurusan' => $jurusan
        ]);
    }
    public function store()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'role'     => 'site_admin',
        ];

        $this->userModel->insert($data);

        return redirect()->to('/site_admin')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $userModel = new \App\Models\UserModel();

        $siteAdmin = $userModel->find($id);

        if (!$siteAdmin) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Admin tidak ditemukan");
        }

        return view('Users/site_admin/edit', ['siteAdmin' => $siteAdmin]);
    }

    public function update($id)
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
        ];

        $this->userModel->update($id, $data);

        return redirect()->to('/site_admin')->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/site_admin')->with('success', 'Data berhasil dihapus.');
    }

    public function import()
    {
        return view('Users/site_admin/import');
    }

    public function prosesImport()
    {
        $file = $this->request->getFile('file');

        if ($file->isValid() && !$file->hasMoved()) {
            $csv = fopen($file->getTempName(), 'r');
            $skipHeader = $this->request->getPost('skip_header');
            $siteAdminModel = new \App\Models\SiteAdminModel();

            $rowNumber = 0;
            while (($row = fgetcsv($csv, 1000, ",")) !== FALSE) {
                $rowNumber++;

                if ($skipHeader && $rowNumber == 1) {
                    continue;
                }

                if (count($row) < 3) {
                    continue;
                }

                $data = [
                    'username' => trim($row[0]),
                    'nama'     => trim($row[1]),
                    'email'    => trim($row[2]),
                    'role'     => 'site_admin', // INI WAJIB
                ];

                $siteAdminModel->insert($data);
            }

            fclose($csv);

            return redirect()->to('/site_admin')->with('success', 'Import berhasil!');
        } else {
            return redirect()->to('/site_admin/import')->with('error', 'File tidak valid!');
        }
    }


    public function downloadTemplate()
    {
        $filename = "template_site_admin.csv";

        $header = ["Username", "Nama", "Email"];

        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=\"$filename\"");

        $file = fopen('php://output', 'w');
        fputcsv($file, $header);
        fclose($file);
        exit;
    }
}
