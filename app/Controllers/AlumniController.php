<?php

namespace App\Controllers;

use App\Models\AlumniModel;
use App\Models\OrganizationModel;
use App\Models\KuesionerModel;


class AlumniController extends BaseController
{
    protected $alumniModel;
    protected $organizationModel;
    protected $KuesionerModel;

    public function __construct()
    {
        $this->alumniModel = new AlumniModel();
        $this->organizationModel = new OrganizationModel();
        $this->KuesionerModel = new KuesionerModel();
    }

    public function index()
    {
        $filter = $this->request->getGet();

        // Ambil semua alumni
        $builder = $this->alumniModel->builder();
        $builder->where('role', 'alumni');

        // Filter manual (form input)
        if (!empty($filter['nim'])) {
            $builder->like('nim', $filter['nim']);
        }
        if (!empty($filter['nama'])) {
            $builder->like('nama', $filter['nama']);
        }
        if (!empty($filter['jurusan'])) {
            $builder->where('jurusan', $filter['jurusan']);
        }
        if (!empty($filter['program_studi'])) {
            $builder->where('program_studi', $filter['program_studi']);
        }
        if (!empty($filter['angkatan'])) {
            $builder->where('angkatan', $filter['angkatan']);
        }

        // Ambil semua alumni hasil filter di atas
        $alumniList = $builder->get()->getResultArray();

        // Ambil semua kuesioner yang punya conditional_logic
        $kuesionerList = $this->KuesionerModel
            ->where('conditional_logic IS NOT NULL')
            ->findAll();

        // Filter alumni berdasarkan conditional logic
        $filteredAlumni = [];
        foreach ($alumniList as $alumni) {
            $valid = true;

            foreach ($kuesionerList as $kuesioner) {
                $logic = json_decode($kuesioner['conditional_logic'], true);

                if (!$logic || !isset($logic['options'], $logic['isnot'], $logic['value'])) {
                    continue; // skip logic yang rusak
                }

                for ($i = 0; $i < count($logic['options']); $i++) {
                    $field = $logic['options'][$i];
                    $operator = $logic['isnot'][$i];
                    $expectedValue = $logic['value'][$i];
                    $actualValue = $alumni[$field] ?? null;

                    if ($operator === 'is' && $actualValue !== $expectedValue) {
                        $valid = false;
                        break 2;
                    } elseif ($operator === 'is_not' && $actualValue === $expectedValue) {
                        $valid = false;
                        break 2;
                    }
                }
            }

            if ($valid) {
                $filteredAlumni[] = $alumni;
            }
        }

        // Dropdown untuk filter
        $jurusanOptions = $this->alumniModel
            ->distinct()
            ->select('jurusan')
            ->where('role', 'alumni')
            ->where('jurusan IS NOT NULL')
            ->orderBy('jurusan', 'ASC')
            ->findColumn('jurusan') ?? [];

        $prodiOptions = $this->alumniModel
            ->distinct()
            ->select('program_studi')
            ->where('role', 'alumni')
            ->where('program_studi IS NOT NULL')
            ->orderBy('program_studi', 'ASC')
            ->findColumn('program_studi') ?? [];

        return view('users/alumni/index', [
            'alumni' => $filteredAlumni,
            'filter' => $filter,
            'jurusanOptions' => $jurusanOptions,
            'prodiOptions' => $prodiOptions
        ]);
    }


    // In AlumniController.php, modify the dashboard method:

   public function dashboard()
{
    $tracerMessagesModel = new \App\Models\TracerMessagesModel();
    $message = $tracerMessagesModel->where('is_active', 1)->first();
    $loggedInName = session()->get('nama_lengkap') ?? session()->get('username') ?? 'Alumni';

    // Ambil data alumni dari database berdasarkan username
    $alumniModel = new \App\Models\AlumniModel();
    $alumni = $alumniModel->where('username', session()->get('username'))->first();

    $tahunKelulusan = $alumni['tahun_kelulusan'] ?? '-';

    $kuesionerModel = new \App\Models\KuesionerModel();
    $activeKuesionerList = $kuesionerModel->where('active', 'Ya')->findAll(); // <--- ini diperbaiki

    $kuesionerList = []; // <--- TAMBAHAN

    foreach ($activeKuesionerList as $activeKuesioner) { // <--- UBAH dari satu objek ke looping list
        $isEligible = false;
        $eligibilityMessage = '';
        $answerStatus = null;
        $lastAnsweredPage = 1;

        $logic = json_decode($activeKuesioner['conditional_logic'], true);

        if (!empty($logic)) {
            $show = true;

            foreach ($logic as $condition) {
                $field = $condition['ShowIf'] ?? '';
                $operator = $condition['condition'] ?? '';
                $value = $condition['value'] ?? '';

                $userValue = $alumni[$field] ?? null;

                if ($operator === 'is' && (string)$userValue !== (string)$value) {
                    $show = false;
                    $eligibilityMessage = "Kuesioner ini hanya untuk alumni dengan $field = $value.";
                    break;
                }

                if ($operator === 'is_not' && (string)$userValue === (string)$value) {
                    $show = false;
                    $eligibilityMessage = "Kuesioner ini tidak tersedia untuk alumni dengan $field = $value.";
                    break;
                }
            }

            $isEligible = $show;
        } else {
            $isEligible = true;
        }

        $answerModel = new \App\Models\KuesionerAnswerModel();
        $existingAnswer = $answerModel->where('kuesioner_id', $activeKuesioner['id'])
            ->where('user_id', session()->get('user_id'))
            ->first();

        if ($existingAnswer) {
            if ($existingAnswer['status'] === 'draft') {
                $answerStatus = 'draft';
                $lastAnsweredPage = $answerModel->getLastAnsweredPage($activeKuesioner['id'], session()->get('user_id'));
            } else {
                $answerStatus = 'submitted';
            }
        } else {
            $answerStatus = 'not_started';
        }

        $kuesionerList[] = [
            'id' => $activeKuesioner['id'],
            'title' => $activeKuesioner['title'],
            'isEligible' => $isEligible,
            'eligibilityMessage' => $eligibilityMessage,
            'status' => $answerStatus,
            'last_page' => $lastAnsweredPage
        ];
    }

    return view('alumni/dashboard', [
        'message' => $message,
        'loggedInName' => $loggedInName,
        'tahunKelulusan' => $tahunKelulusan,
        'kuesionerList' => $kuesionerList // <--- UBAH ini jadi array semua kuesioner
    ]);
}

    public function add()
    {
        $jurusan = $this->organizationModel->where('parent_id', null)->findAll();
        $program_studi = $this->organizationModel->where('tipe', 'program_studi')->findAll();

        return view('users/alumni/add', compact('jurusan', 'program_studi'));
    }

    public function getProgramStudiByJurusan($jurusan_id)
    {
        $programStudi = $this->organizationModel
            ->where('parent_id', $jurusan_id)
            ->findAll();

        return $this->response->setJSON($programStudi);
    }

    public function store()
    {
        $role = 'alumni'; // Sudah pasti alumni
        $jurusan_id = $this->request->getPost('jurusan_id');
        $program_studi_id = $this->request->getPost('program_studi_id');

        // Validasi role
        if ($role !== 'alumni') {
            return redirect()->back()->withInput()->with('error', 'Role tidak valid');
        }

        // Ambil nama jurusan dan prodi
        $jurusan = $this->organizationModel->find($jurusan_id);
        $program_studi = $this->organizationModel->find($program_studi_id);

        $data = [
            'username'      => $this->request->getPost('username'),
            'email'         => $this->request->getPost('email'),
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'          => $role,
            'status'        => $this->request->getPost('status') === 'Aktif' ? 'active' : 'inactive',
            'nama'          => $this->request->getPost('nama'),
            'nim'           => $this->request->getPost('nim'),
            'jurusan'       => $jurusan['name'] ?? null,
            'program_studi' => $program_studi['name'] ?? null,
            'angkatan'      => $this->request->getPost('angkatan'),
            'ipk'           => $this->request->getPost('ipk'),
            'alamat1'       => $this->request->getPost('alamat1'),
            'alamat2'       => $this->request->getPost('alamat2'),
            'tahun_kelulusan' => $this->request->getPost('tahun_kelulusan'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin') === 'Laki-laki' ? 'L' : 'P',
            'no_hp'         => $this->request->getPost('no_hp'),
            'kota'          => $this->request->getPost('kota'),
            'provinsi'      => $this->request->getPost('provinsi'),
            'kodepos'       => $this->request->getPost('kodepos'),
            'created_at'    => date('Y-m-d H:i:s'),
        ];

        $this->alumniModel->insert($data);

        return redirect()->to('/alumni')->with('message', 'Alumni berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $alumniModel = new \App\Models\AlumniModel();
        $organizationModel = new \App\Models\OrganizationModel();

        $alumni = $alumniModel->find($id);
        if (!$alumni) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Alumni tidak ditemukan');
        }

        // Ambil semua program studi (yang punya parent_id)
        $program_studi = $organizationModel
            ->where('parent_id !=', null)
            ->findAll();

        // Ambil jurusan (yang tidak punya parent_id)
        $jurusan = $organizationModel
            ->where('parent_id', null)
            ->findAll();

        return view('Users/alumni/edit', [
            'alumni' => $alumni,
            'jurusan' => $jurusan,
            'program_studi' => $program_studi,
        ]);
    }


    public function update($id)
    {
        $alumni = $this->alumniModel->find($id);
        if (!$alumni) {
            return redirect()->to('/alumni')->with('error', 'Alumni tidak ditemukan.');
        }

        $jurusan_id = $this->request->getPost('jurusan_id');
        $program_studi_id = $this->request->getPost('program_studi_id');

        $jurusan = $this->organizationModel->find($jurusan_id);
        $program_studi = $this->organizationModel->find($program_studi_id);

        $data = [
            'username'      => $this->request->getPost('username'),
            'email'         => $this->request->getPost('email'),
            'nama'          => $this->request->getPost('nama'),
            'nim'           => $this->request->getPost('nim'),
            'jurusan'       => $jurusan['name'] ?? null,
            'program_studi' => $program_studi['name'] ?? null,
            'angkatan'      => $this->request->getPost('angkatan'),
            'ipk'           => $this->request->getPost('ipk'),
            'alamat1'       => $this->request->getPost('alamat1'),
            'alamat2'       => $this->request->getPost('alamat2'),
            'tahun_kelulusan' => $this->request->getPost('tahun_kelulusan'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin') === 'Laki-laki' ? 'L' : 'P',
            'no_hp'         => $this->request->getPost('no_hp'),
            'kota'          => $this->request->getPost('kota'),
            'provinsi'      => $this->request->getPost('provinsi'),
            'kodepos'       => $this->request->getPost('kodepos'),
            'status'        => $this->request->getPost('status') === 'Aktif' ? 'active' : 'inactive',
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->alumniModel->update($id, $data);

        return redirect()->to('/alumni')->with('message', 'Data alumni berhasil diupdate.');
    }

    public function delete($id)
    {
        $this->alumniModel->delete($id);
        return redirect()->to('/alumni')->with('message', 'Data alumni berhasil dihapus.');
    }

    public function import()
    {
        return view('users/alumni/import');
    }
    public function prosesImport()
    {
        $file = $this->request->getFile('file');

        if ($file->isValid() && !$file->hasMoved()) {
            $csv = fopen($file->getTempName(), 'r');
            $skipHeader = $this->request->getPost('skip_header');
            $alumniModel = new \App\Models\AlumniModel();

            $rowNumber = 0;
            while (($row = fgetcsv($csv, 1000, ",")) !== FALSE) {
                $rowNumber++;

                // Lewatkan baris header
                if ($skipHeader && $rowNumber == 1) {
                    continue;
                }

                // Pastikan jumlah kolom sesuai dengan header
                if (count($row) < 10) {
                    continue;
                }

                $data = [
                    'nim'           => trim($row[0]),
                    'username'      => trim($row[1]),
                    'email'         => trim($row[2]),
                    'nama'          => trim($row[3]),
                    'jurusan'       => trim($row[4]),
                    'program_studi' => trim($row[5]),
                    'angkatan'      => trim($row[6]),
                    'ipk'           => trim(str_replace(',', '.', $row[7])),
                    'alamat1'       => trim($row[8]),
                    'alamat2'       => trim($row[9])
                ];

                $alumniModel->insert($data);
            }

            fclose($csv);

            return redirect()->to('/alumni')->with('success', 'Import berhasil!');
        } else {
            return redirect()->to('/alumni/import')->with('error', 'File tidak valid!');
        }
    }

    public function isiKuesioner($id)
    {
        // Kode untuk menampilkan halaman kuesioner
    }

    public function downloadTemplate()
    {
        $filename = "template_alumni.csv";

        // Header kolom CSV
        $header = [
            "NIM",
            "Username",
            "Email",
            "Nama",
            "Jurusan",
            "Program Studi",
            "Angkatan",
            "IPK",
            "Alamat1",
            "Alamat2"
        ];

        // Buka output sebagai file CSV
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=\"$filename\"");

        $file = fopen('php://output', 'w');

        // Tulis header ke file CSV
        fputcsv($file, $header);

        fclose($file);
        exit;
    }
}
