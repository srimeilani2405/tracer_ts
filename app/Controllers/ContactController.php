<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContactModel;
use App\Models\UserModel;
use App\Models\TracerContactModel;

class ContactController extends BaseController
{
    protected $contactModel;
    protected $userModel;
    protected $tracerContactModel;

    private $positions = [
        'Wakil Direktur Bidang Kemahasiswaan',
        'Team Tracer Study POLBAN',
        'Surveyor Tahun 2024',
        'Surveyor Tahun 2025',
        'Dosen Pembimbing',
        'Koordinator Alumni',
        'Koordinator Surveyor Tahun 2025'
    ];

    private $contactTypes = [
        'directorate' => 'Wakil Direktur Bidang Kemahasiswaan',
        'team'        => 'Team Tracer Study POLBAN',
        'address'     => 'Alamat',
        'surveyor'    => 'Surveyor',
        'coordinator' => 'Koordinator Surveyor'
    ];

    public function __construct()
    {
        $this->contactModel = new ContactModel();
        $this->userModel = new UserModel();
        $this->tracerContactModel = new TracerContactModel();
    }

    public function index()
    {
        $tahun = $this->request->getGet('tahun');
        $contacts = $this->contactModel->orderBy('sort_order', 'ASC')->findAll();
        $surveyors = $this->tracerContactModel->getSurveyorContacts($tahun);
        $coordinators = $this->tracerContactModel->getCoordinatorContacts($tahun);

        $tahunOptions = $this->tracerContactModel->distinct()
            ->select('tahun')
            ->groupStart()
            ->where('contact_type', 'surveyor')
            ->orWhere('contact_type', 'coordinator')
            ->groupEnd()
            ->where('tahun IS NOT NULL')
            ->orderBy('tahun', 'DESC')
            ->findAll();

        return view('contacts/index', [
            'contacts' => $contacts,
            'surveyors' => $surveyors,
            'coordinators' => $coordinators,
            'contactTypes' => $this->contactTypes,
            'selectedTahun' => $tahun,
            'tahunOptions' => array_column($tahunOptions, 'tahun')
        ]);
    }

    public function create()
    {
        $tahunOptions = $this->userModel->distinct()
            ->select('tahun_kelulusan')
            ->where('role', 'alumni')
            ->where('tahun_kelulusan !=', '0000')
            ->where('tahun_kelulusan >=', 2000)
            ->orderBy('tahun_kelulusan', 'DESC')
            ->findAll();

        $programStudiOptions = $this->userModel->getProgramStudiOptions();
        $jurusanOptions = $this->tracerContactModel->getJurusanOptions();

        return view('contacts/create', [
            'positions' => $this->positions,
            'contactTypes' => $this->contactTypes,
            'tahunOptions' => array_column($tahunOptions, 'tahun_kelulusan'),
            'programStudiOptions' => $programStudiOptions,
            'jurusanOptions' => $jurusanOptions
        ]);
    }

    public function store()
    {
        $contactType = $this->request->getPost('contact_type');
        $tahun = $this->request->getPost('tahun');

        $data = [
            'name'          => $this->request->getPost('name'),
            'email'         => $this->request->getPost('email'),
            'phone'         => $this->request->getPost('phone'),
            'position'      => $this->request->getPost('position'),
            'qualification' => $this->request->getPost('qualification'),
            'contact_type'  => $contactType,
            'tahun'         => $tahun,
            'program_studi' => $this->request->getPost('program_studi'),
            'jurusan'       => $this->request->getPost('jurusan'),
            'sort_order'    => $this->request->getPost('sort_order'),
            'show_email'    => $this->request->getPost('show_email') ?? 0,
            'show_phone'    => $this->request->getPost('show_phone') ?? 0,
        ];

        $validationRules = [
            'name'          => 'required|min_length[3]|max_length[255]',
            'email'         => 'required|valid_email',
            'phone'         => 'required|min_length[10]|max_length[15]',
            'position'      => 'permit_empty|max_length[255]',
            'qualification' => 'permit_empty|max_length[255]',
            'contact_type'  => 'required|in_list[' . implode(',', array_keys($this->contactTypes)) . ']',
            'tahun'         => 'permit_empty|numeric|min_length[4]|max_length[4]',
            'program_studi' => 'permit_empty|max_length[100]',
            'jurusan'       => 'permit_empty|max_length[100]',
            'sort_order'    => 'required|integer',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Validasi tambahan untuk surveyor dan coordinator
        if ($contactType === 'surveyor') {
            if (empty($tahun)) {
                return redirect()->back()->withInput()->with('error', 'Tahun harus diisi untuk surveyor.');
            }
            $data['position'] = 'Surveyor Tahun ' . $tahun;
            $insertSuccess = $this->tracerContactModel->insert($data);
        } elseif ($contactType === 'coordinator') {
            if (empty($data['jurusan'])) {
                return redirect()->back()->withInput()->with('error', 'Jurusan harus diisi untuk koordinator.');
            }
            $data['position'] = 'Koordinator Surveyor Tahun ' . $tahun;
            $insertSuccess = $this->tracerContactModel->insert($data);
        } else {
            // Untuk tipe lain seperti team, directorate, dst
            $insertSuccess = $this->contactModel->insert($data);
        }

        if ($insertSuccess) {
            return redirect()->to('/contacts')->with('success', 'Kontak berhasil disimpan.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan kontak.');
    }

    public function edit($id)
    {
        // Check both contact tables
        $contact = $this->contactModel->find($id);
        if (!$contact) {
            $contact = $this->tracerContactModel->find($id);
        }

        if (!$contact) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kontak tidak ditemukan');
        }

        // Get alumni name if alumni_id exists
        if (!empty($contact['alumni_id'])) {
            $alumni = $this->userModel->find($contact['alumni_id']);
            $contact['alumni_name'] = $alumni ? $alumni['nama'] : '';
        }

        $tahunOptions = $this->userModel->distinct()
            ->select('tahun_kelulusan')
            ->where('role', 'alumni')
            ->where('tahun_kelulusan !=', '0000')
            ->where('tahun_kelulusan >=', 2000)
            ->orderBy('tahun_kelulusan', 'DESC')
            ->findAll();

        $jurusanOptions = $this->tracerContactModel->getJurusanOptions();

        return view('contacts/edit', [
            'contact' => $contact,
            'positions' => $this->positions,
            'contactTypes' => $this->contactTypes,
            'tahunOptions' => array_column($tahunOptions, 'tahun_kelulusan'),
            'jurusanOptions' => $jurusanOptions
        ]);
    }
    public function update($id)
    {
        // Check both contact tables
        $contact = $this->contactModel->find($id);
        $isTracerContact = false;

        if (!$contact) {
            $contact = $this->tracerContactModel->find($id);
            $isTracerContact = true;
        }

        if (!$contact) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kontak tidak ditemukan');
        }

        $contactType = $this->request->getPost('contact_type');
        $tahun = $this->request->getPost('tahun');

        $data = [
            'name'          => $this->request->getPost('name'),
            'email'         => $this->request->getPost('email'),
            'phone'         => $this->request->getPost('phone'),
            'position'      => $this->request->getPost('position'),
            'qualification' => $this->request->getPost('qualification'),
            'contact_type'  => $contactType,
            'tahun'         => $tahun,
            'program_studi' => $this->request->getPost('program_studi'),
            'jurusan'       => $this->request->getPost('jurusan'),
            'alumni_id'     => $this->request->getPost('alumni_id'),
            'sort_order'    => $this->request->getPost('sort_order'),
            'show_email'    => $this->request->getPost('show_email') ? 1 : 0,
            'show_phone'    => $this->request->getPost('show_phone') ? 1 : 0,
        ];

        $validationRules = [
            'name'          => 'required|min_length[3]|max_length[255]',
            'email'         => 'required|valid_email',
            'phone'         => 'required|min_length[10]|max_length[15]',
            'position'      => 'required|max_length[255]',
            'qualification' => 'permit_empty|max_length[255]',
            'contact_type'  => 'required|in_list[' . implode(',', array_keys($this->contactTypes)) . ']',
            'tahun'         => 'permit_empty|numeric|min_length[4]|max_length[4]',
            'program_studi' => 'permit_empty|max_length[100]',
            'jurusan'       => 'permit_empty|max_length[100]',
            'alumni_id'     => 'permit_empty|numeric',
            'sort_order'    => 'required|integer',
            'show_email'    => 'permit_empty|in_list[0,1]',
            'show_phone'    => 'permit_empty|in_list[0,1]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle position based on contact type
        if ($contactType === 'surveyor') {
            if (empty($tahun)) {
                return redirect()->back()->withInput()->with('error', 'Tahun harus diisi untuk surveyor.');
            }
            $data['position'] = 'Surveyor Tahun ' . $tahun;
        } elseif ($contactType === 'coordinator') {
            if (empty($data['jurusan'])) {
                return redirect()->back()->withInput()->with('error', 'Jurusan harus diisi untuk koordinator.');
            }
            $data['position'] = 'Koordinator Surveyor Tahun ' . $tahun;
        }

        // Determine which model to use for update
        if (in_array($contactType, ['surveyor', 'coordinator'])) {
            $this->tracerContactModel->update($id, $data);
        } else {
            $this->contactModel->update($id, $data);
        }

        return redirect()->to('/contacts')->with('success', 'Kontak berhasil diperbarui.');
    }

    public function delete($id)
    {
        $contact = $this->contactModel->find($id);

        if (!$contact) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->contactModel->delete($id);
        return redirect()->to('/contacts')->with('success', 'Kontak berhasil dihapus.');
    }

    public function getAlumniByTahun()
    {
        $tahun = $this->request->getGet('tahun');

        $alumni = $this->userModel->select('id, nama, program_studi')
            ->where('role', 'alumni')
            ->where('tahun_kelulusan', $tahun)
            ->findAll();

        return $this->response->setJSON($alumni);
    }

    public function getAlumniDetail()
    {
        $id = $this->request->getGet('id');

        $alumni = $this->userModel->select('nama, email, no_hp, program_studi')
            ->where('id', $id)
            ->first();

        return $this->response->setJSON($alumni);
    }
}
