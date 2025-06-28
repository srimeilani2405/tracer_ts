<?php

namespace App\Controllers;

use App\Models\OrganizationModel;
use App\Models\JurusanModel;
use App\Models\ProgramStudiModel;
use App\Models\TypeModel;

class OrganizationController extends BaseController
{
    protected $organizationModel;
    protected $jurusanModel;
    protected $programStudiModel;
    protected $organizationTypeModel; // Tambahkan ini

    public function __construct()
    {
        $this->organizationModel = new OrganizationModel();
        $this->jurusanModel = new JurusanModel();
        $this->programStudiModel = new ProgramStudiModel();
        $this->organizationTypeModel = new TypeModel(); // Tambahkan ini
    }

    // Menampilkan data berdasarkan tipe
    public function index($type = null)
    {
        if ($type === 'jurusan') {
            $jurusan = $this->organizationModel->getJurusan();
            foreach ($jurusan as &$j) {
                $j['prodi'] = $this->organizationModel->getProgramStudiByJurusan($j['id']);
            }
            return view('Organization/index', ['jurusan' => $jurusan, 'type' => 'jurusan']);
        } elseif ($type === 'program-studi') {
            $prodi = $this->organizationModel->getProgramStudiWithJurusan();
            return view('Organization/index', ['prodi' => $prodi, 'type' => 'program-studi']);
        } else {
            $allData = $this->organizationModel->getHierarchy();
            return view('Organization/index', ['allData' => $allData, 'type' => 'hirarki']);
        }
    }

    // Menampilkan daftar unit (organisasi utama)
    public function units()
    {
        $organizations = $this->organizationModel->where('parent_id', null)
            ->where('deleted_at', null)
            ->findAll();

        foreach ($organizations as &$org) {
            $org['children'] = $this->organizationModel->where('parent_id', $org['id'])
                ->where('deleted_at', null)
                ->findAll();
        }

        return view('organization/units', ['organizations' => $organizations]);
    }

    // Menampilkan form untuk menambah unit
    public function create()
{
    $organizations = $this->organizationModel->getJurusan();
    $organizationTypes = $this->organizationTypeModel->findAll(); // Ambil dari DB

    return view('organization/create', [
        'organizations' => $organizations,
        'organizationTypes' => $organizationTypes
    ]);
}


    // Menyimpan data organisasi
    public function store()
    {
        $rules = [
            'name' => 'required',
            'tipe' => 'required|in_list[Jurusan,Program Studi]',
            'parent_id' => 'permit_empty|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'short_name' => $this->request->getPost('short_name'),
            'slug' => $this->request->getPost('slug'),
            'description' => $this->request->getPost('description'),
            'tipe' => $this->request->getPost('tipe'),
            'urutan' => $this->request->getPost('urutan'),
            'parent_id' => $this->request->getPost('tipe') === 'Program Studi' ? $this->request->getPost('parent_id') : null
        ];

        $this->organizationModel->insert($data);
        return redirect()->to('/organisasi/units')->with('message', 'Data berhasil disimpan');
    }


    public function edit($id)
    {
        $organization = $this->organizationModel->find($id);
        if (!$organization) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Organisasi dengan ID $id tidak ditemukan.");
        }
    
        $organizations = $this->organizationModel->getJurusan();
        $organizationTypes = $this->organizationTypeModel->findAll(); // Ambil dari DB
    
        return view('Organization/edit', [
            'organization' => $organization,
            'organizations' => $organizations,
            'organizationTypes' => $organizationTypes
        ]);
    }

    // Mengupdate data unit
    public function update($id)
    {
        $rules = [
            'name' => 'required',
            'tipe' => 'required|in_list[Jurusan,Program Studi]',
            'parent_id' => 'permit_empty|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id' => $id,
            'name' => $this->request->getPost('name'),
            'short_name' => $this->request->getPost('short_name'),
            'slug' => $this->request->getPost('slug'),
            'description' => $this->request->getPost('description'),
            'tipe' => $this->request->getPost('tipe'),
            'urutan' => $this->request->getPost('urutan'),
            'parent_id' => $this->request->getPost('tipe') === 'Program Studi' ? $this->request->getPost('parent_id') : null
        ];

        $this->organizationModel->save($data);
        return redirect()->to('/organisasi/units')->with('message', 'Data berhasil diperbarui');
    }

    // Menghapus unit
    public function delete($id)
    {
        $this->organizationModel->delete($id);
        return redirect()->to('/organisasi/units')->with('message', 'Data berhasil dihapus');
    }

    // Menampilkan detail unit
    public function view($id)
    {
        $organization = $this->organizationModel->find($id);
        if (!$organization) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Organisasi dengan ID $id tidak ditemukan.");
        }

        $parent = $organization['parent_id'] ? $this->organizationModel->find($organization['parent_id']) : null;

        return view('Organization/view_unit', [
            'organization' => $organization,
            'parent' => $parent
        ]);
    }

    // Menambahkan unit baru (untuk jurusan atau program studi)
    public function addUnit()
    {
        $nama = $this->request->getPost('nama');
        $tipe = $this->request->getPost('tipe');

        $unitData = [
            'nama' => $nama,
            'tipe' => $tipe
        ];
        $this->organizationModel->insert($unitData);

        if ($tipe == "Jurusan") {
            $this->jurusanModel->insert(['nama_jurusan' => $nama]);
        } elseif ($tipe == "Program Studi") {
            $this->programStudiModel->insert(['nama_prodi' => $nama]);
        }

        return redirect()->to('/organisasi/units')->with('success', 'Data berhasil ditambahkan');
    }

    // Menghapus unit
    public function deleteUnit($id)
    {
        $unit = $this->organizationModel->find($id);

        if ($unit) {
            if ($unit['tipe'] == "Jurusan") {
                $this->jurusanModel->where('nama_jurusan', $unit['nama'])->delete();
            } elseif ($unit['tipe'] == "Program Studi") {
                $this->programStudiModel->where('nama_prodi', $unit['nama'])->delete();
            }

            $this->organizationModel->delete($id);
        }

        return redirect()->to('/organisasi/units')->with('success', 'Data berhasil dihapus');
    }

    // Mendapatkan data jurusan
    public function getJurusan()
    {
        $jurusan = $this->jurusanModel->findAll();
        return $this->response->setJSON($jurusan);
    }

    // Mendapatkan program studi berdasarkan jurusan
    public function getProgramStudiByJurusan($jurusan_id)
    {
        $prodi = $this->programStudiModel->where('jurusan_id', $jurusan_id)->findAll();
        return $this->response->setJSON($prodi);
    }

    // Menyimpan data jurusan atau program studi
    public function save()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'type' => $this->request->getPost('type')
        ];

        $orgId = $this->organizationModel->insert($data);

        if ($this->request->getPost('type') == 'jurusan') {
            $this->jurusanModel->insert([
                'name' => $this->request->getPost('name'),
                'organization_id' => $orgId
            ]);
        } elseif ($this->request->getPost('type') == 'program_studi') {
            $this->programStudiModel->insert([
                'name' => $this->request->getPost('name'),
                'organization_id' => $orgId
            ]);
        }

        return redirect()->to('/organisasi/units');
    }

    // Menampilkan program studi
    public function programStudi()
    {
        $organizationModel = new OrganizationModel();
        $data['program_studi'] = $organizationModel->getProgramStudi();

        return view('program_studi/index', $data);
    }
}
