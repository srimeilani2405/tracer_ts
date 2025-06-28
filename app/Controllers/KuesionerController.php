<?php

namespace App\Controllers;

use App\Models\KuesionerModel;
use App\Models\DataIsianModel;
use App\Models\SoalModel;
use App\Models\HalamanModel;
use App\Models\KuesionerPageModel;
use App\Models\KuesionerSectionModel;
use App\Models\KuesionerFieldModel;
use App\Models\KuesionerAnswerModel;
use CodeIgniter\API\ResponseTrait;

class KuesionerController extends BaseController
{
    use ResponseTrait;

    protected $kuesionerModel;
    protected $dataIsianModel;
    protected $soalModel;
    protected $halamanModel;
    protected $kuesionerPageModel;
    protected $kuesionerSectionModel;
    protected $kuesionerFieldModel;
    protected $kuesionerAnswerModel;

    protected $db;

    public function __construct()
    {
        $this->kuesionerModel = new KuesionerModel();
        $this->dataIsianModel = new DataIsianModel();
        $this->soalModel = new SoalModel();
        $this->halamanModel = new HalamanModel();
        $this->kuesionerPageModel = new KuesionerPageModel();
        $this->kuesionerSectionModel = new KuesionerSectionModel();
        $this->kuesionerFieldModel = new KuesionerFieldModel();
        $this->kuesionerAnswerModel = new KuesionerAnswerModel();
        $this->db = \Config\Database::connect();

        helper(['form', 'url']);
    }

    public function index()
    {
        $data = [
            'kuesioner' => $this->kuesionerModel->findAll(),
            'title' => 'Daftar Kuesioner'
        ];
        return view('kuesioner/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Kuesioner Baru'
        ];
        return view('kuesioner/tambah', $data);
    }

    public function simpan()
    {
        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'deskripsi' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'active' => 'Tidak',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->kuesionerModel->insert($data);
        return redirect()->to('/Kuesioner')->with('message', 'Kuesioner berhasil ditambahkan');
    }


    public function edit($id)
    {
        $kuesioner = $this->kuesionerModel->find($id);
        if (!$kuesioner) {
            return redirect()->to('/Kuesioner')->with('error', 'Kuesioner tidak ditemukan');
        }

        $data = [
            'kuesioner' => $kuesioner,
            'title' => 'Edit Kuesioner'
        ];
        return view('kuesioner/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $kuesioner = $this->kuesionerModel->find($id);

        if (!$kuesioner) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Kuesioner tidak ditemukan'
            ]);
        }

        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'deskripsi' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($this->request->getPost('conditional_logic')) {
            $data['conditional_logic'] = $this->request->getPost('conditional_logic');
        }

        if ($this->kuesionerModel->update($id, $data)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Kuesioner berhasil diperbarui'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menyimpan perubahan'
            ]);
        }
    }

    public function delete($id)
    {
        $kuesioner = $this->kuesionerModel->find($id);
        if (!$kuesioner) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Kuesioner tidak ditemukan'
            ]);
        }

        // Hapus semua data terkait
        $this->deleteRelatedData($id);

        $this->kuesionerModel->delete($id);
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Kuesioner berhasil dihapus'
        ]);
    }

    protected function deleteRelatedData($kuesionerId)
    {
        // Hapus halaman dan section terkait
        $pages = $this->kuesionerPageModel->where('kuesioner_id', $kuesionerId)->findAll();
        foreach ($pages as $page) {
            // Hapus field/pertanyaan di section
            $sections = $this->kuesionerSectionModel->where('page_id', $page['id'])->findAll();
            foreach ($sections as $section) {
                $this->kuesionerFieldModel->where('section_id', $section['id'])->delete();
            }

            $this->kuesionerSectionModel->where('page_id', $page['id'])->delete();
            $this->kuesionerPageModel->delete($page['id']);
        }

        // Hapus data isian terkait
        $this->dataIsianModel->where('kuesioner_id', $kuesionerId)->delete();
    }

    public function toggleStatus($id)
    {
        $kuesioner = $this->kuesionerModel->find($id);
        if (!$kuesioner) {
            return $this->response->setJSON(['success' => false]);
        }

        $newStatus = ($kuesioner['active'] === 'Ya') ? 'Tidak' : 'Ya';
        $this->kuesionerModel->update($id, ['active' => $newStatus]);

        return $this->response->setJSON([
            'success' => true,
            'status' => $newStatus
        ]);
    }


    // In KuesionerController.php, add this method:

    public function lihatJawaban($kuesionerId)
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/login');
        }

        $kuesioner = $this->kuesionerModel->find($kuesionerId);
        if (!$kuesioner) {
            return redirect()->to('/kuesioner')->with('error', 'Kuesioner tidak ditemukan');
        }

        $answer = $this->kuesionerAnswerModel
            ->where('kuesioner_id', $kuesionerId)
            ->where('user_id', $userId)
            ->first();

        if (!$answer) {
            return redirect()->to('/kuesioner')->with('error', 'Anda belum mengisi kuesioner ini');
        }

        // Get the questionnaire structure
        $pages = $this->kuesionerPageModel
            ->where('kuesioner_id', $kuesionerId)
            ->orderBy('ordering_count', 'ASC')
            ->findAll();

        $sections = [];
        $fields = [];

        foreach ($pages as $page) {
            $pageSections = $this->kuesionerSectionModel
                ->where('page_id', $page['id'])
                ->orderBy('ordering_count', 'ASC')
                ->findAll();

            foreach ($pageSections as $section) {
                $sectionFields = $this->kuesionerFieldModel
                    ->where('section_id', $section['id'])
                    ->orderBy('ordering_count', 'ASC')
                    ->findAll();

                // Decode options if any
                foreach ($sectionFields as &$field) {
                    if (!empty($field['options'])) {
                        $field['options'] = json_decode($field['options'], true);
                    }
                }

                $sections[$page['id']][] = $section;
                $fields[$section['id']] = $sectionFields;
            }
        }

        // Decode answers
        $answers = json_decode($answer['answers'], true) ?? [];

        return view('kuesioner/lihat_jawaban', [
            'kuesioner' => $kuesioner,
            'pages' => $pages,
            'sections' => $sections,
            'fields' => $fields,
            'answers' => $answers,
            'title' => 'Jawaban Kuesioner: ' . $kuesioner['title']
        ]);
    }

    public function clone($id)
    {
        $kuesioner = $this->kuesionerModel->find($id);
        if (!$kuesioner) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Kuesioner tidak ditemukan'
            ]);
        }

        $newKuesioner = [
            'title' => 'Clone - ' . $kuesioner['title'],
            'deskripsi' => $kuesioner['deskripsi'],
            'active' => 'Tidak',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $newId = $this->kuesionerModel->insert($newKuesioner);
        if (!$newId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal meng-clone kuesioner'
            ]);
        }

        // Clone pages, sections, dan fields
        $this->clonePagesSectionsAndFields($id, $newId);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Kuesioner berhasil di-clone',
            'newId' => $newId
        ]);
    }

    protected function clonePagesSectionsAndFields($originalId, $newId)
    {
        $pages = $this->kuesionerPageModel->where('kuesioner_id', $originalId)->findAll();
        foreach ($pages as $page) {
            $newPage = [
                'kuesioner_id' => $newId,
                'title' => $page['title'],
                'deskripsi' => $page['deskripsi'],
                'conditional_logic' => $page['conditional_logic'],
                'ordering_count' => $page['ordering_count'],
                'created_on' => date('Y-m-d H:i:s')
            ];

            $newPageId = $this->kuesionerPageModel->insert($newPage);

            // Clone sections
            $sections = $this->kuesionerSectionModel->where('page_id', $page['id'])->findAll();
            foreach ($sections as $section) {
                $newSection = [
                    'kuesioner_id' => $newId,
                    'page_id' => $newPageId,
                    'title' => $section['title'],
                    'deskripsi' => $section['deskripsi'],
                    'section_options' => $section['section_options'],
                    'fields' => $section['fields'],
                    'conditional_logic' => $section['conditional_logic'],
                    'ordering_count' => $section['ordering_count'],
                    'created_on' => date('Y-m-d H:i:s')
                ];

                $newSectionId = $this->kuesionerSectionModel->insert($newSection);

                // Clone fields/pertanyaan
                $fields = $this->kuesionerFieldModel->where('section_id', $section['id'])->findAll();
                foreach ($fields as $field) {
                    $newField = [
                        'section_id' => $newSectionId,
                        'type' => $field['type'],
                        'label' => $field['label'],
                        'options' => $field['options'],
                        'required' => $field['required'],
                        'ordering_count' => $field['ordering_count'],
                        'created_on' => date('Y-m-d H:i:s')
                    ];

                    $this->kuesionerFieldModel->insert($newField);
                }
            }
        }
    }

    public function tinjau_kuesioner($id)
    {
        $kuesioner = $this->kuesionerModel->find($id);
        if (!$kuesioner) {
            return redirect()->to('/Kuesioner')->with('error', 'Kuesioner tidak ditemukan');
        }

        $halamanAktif = $this->request->getGet('halaman') ?? 1;
        $daftar_halaman = $this->halamanModel->where('id_kuesioner', $id)->findAll();
        $soal_kuesioner = $this->soalModel
            ->where('id_kuesioner', $id)
            ->where('id_halaman', $halamanAktif)
            ->findAll();

        $data = [
            'id_kuesioner' => $id,
            'kuesioner' => $kuesioner,
            'daftar_halaman' => $daftar_halaman,
            'soal_kuesioner' => $soal_kuesioner,
            'title' => 'Tinjau Kuesioner'
        ];
        return view('kuesioner/tinjau_kuesioner', $data);
    }

    public function unduh($id)
    {
        $kuesioner = $this->kuesionerModel->find($id);
        if (!$kuesioner) {
            return redirect()->to('/Kuesioner')->with('error', 'Kuesioner tidak ditemukan');
        }

        $filename = 'kuesioner_' . $kuesioner['id'] . '.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Judul', 'Deskripsi', 'Status', 'Dibuat Pada']);
        fputcsv($output, [
            $kuesioner['id'],
            $kuesioner['title'],
            $kuesioner['deskripsi'],
            $kuesioner['active'],
            $kuesioner['created_at']
        ]);
        fclose($output);
        exit;
    }

    // API Endpoints untuk halaman
    public function getPages($kuesionerId)
    {
        $pages = $this->kuesionerPageModel
            ->select('kuesioner_page.*, COUNT(kuesioner_kuesioner_section.id) as section_count')
            ->join('kuesioner_kuesioner_section', 'kuesioner_kuesioner_section.page_id = kuesioner_page.id', 'left')
            ->where('kuesioner_page.kuesioner_id', $kuesionerId)
            ->groupBy('kuesioner_page.id')
            ->orderBy('kuesioner_page.ordering_count', 'ASC')
            ->findAll();

        return $this->respond([
            'success' => true,
            'data' => $pages
        ]);
    }

    public function addPage()
    {
        if (!$this->request->isAJAX()) {
            return $this->failForbidden('Only AJAX requests are allowed');
        }

        $rules = [
            'kuesioner_id' => 'required|numeric',
            'title' => 'required|min_length[3]|max_length[255]'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'kuesioner_id' => $this->request->getPost('kuesioner_id'),
            'title' => $this->request->getPost('title'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'conditional_logic' => $this->request->getPost('conditional_logic'),
            'ordering_count' => $this->kuesionerPageModel->getNextOrderingCount($this->request->getPost('kuesioner_id')),
            'created_on' => date('Y-m-d H:i:s')
        ];

        try {
            $pageId = $this->kuesionerPageModel->insert($data);

            if ($pageId) {
                return $this->respond([
                    'success' => true,
                    'message' => 'Halaman berhasil ditambahkan',
                    'data' => $this->kuesionerPageModel->find($pageId)
                ]);
            }

            return $this->fail('Gagal menambahkan halaman');
        } catch (\Exception $e) {
            return $this->failServerError('Error: ' . $e->getMessage());
        }
    }
    public function isi($id)
    {
        $kuesioner = $this->kuesionerModel->find($id);
        if (!$kuesioner || $kuesioner['active'] !== 'Ya') {
            return redirect()->to('/kuesioner')->with('error', 'Kuesioner tidak ditemukan atau belum aktif');
        }

        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/login');
        }

        $pages = $this->kuesionerPageModel
            ->where('kuesioner_id', $id)
            ->orderBy('ordering_count', 'ASC')
            ->findAll();

        $sections = [];
        $fields = [];

        foreach ($pages as $page) {
            $pageSections = $this->kuesionerSectionModel
                ->where('page_id', $page['id'])
                ->orderBy('ordering_count', 'ASC')
                ->findAll();

            foreach ($pageSections as $section) {
                $sectionFields = $this->kuesionerFieldModel
                    ->where('section_id', $section['id'])
                    ->orderBy('ordering_count', 'ASC')
                    ->findAll();

                foreach ($sectionFields as &$field) {
                    if (!empty($field['options'])) {
                        $field['options'] = json_decode($field['options'], true);
                    }
                }

                $sections[$page['id']][] = $section;
                $fields[$section['id']] = $sectionFields;
            }
        }

        $answer = $this->kuesionerAnswerModel->getAnswerByUser($id, $userId);
        $jawaban = $answer['answers'] ?? [];
        $answerStatus = $answer['status'] ?? null;

        // Jika ada parameter page, set tab aktif ke halaman tersebut
        $pageParam = $this->request->getGet('page');
        if ($pageParam && is_numeric($pageParam)) {
            $activePage = $pageParam;
        } elseif ($answerStatus === 'draft') {
            $activePage = $this->kuesionerAnswerModel->getLastAnsweredPage($id, $userId);
        } else {
            $activePage = 1;
        }

        return view('kuesioner/isi_kuesioner', [
            'kuesioner' => $kuesioner,
            'pages' => $pages,
            'sections' => $sections,
            'fields' => $fields,
            'jawaban' => $jawaban,
            'answerStatus' => $answerStatus,
            'title' => 'Isi Kuesioner: ' . $kuesioner['title']
        ]);
    }

    public function submit($id)
    {
        $kuesioner = $this->kuesionerModel->find($id);
        if (!$kuesioner) {
            return redirect()->back()->with('error', 'Kuesioner tidak ditemukan');
        }

        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/login');
        }

        $answers = $this->request->getPost('answers');
        if (empty($answers)) {
            return redirect()->back()->with('error', 'Anda belum mengisi jawaban apapun');
        }

        $this->kuesionerAnswerModel->saveAnswers($id, $userId, $answers, 'submitted');
        return redirect()->to('/kuesioner/terimakasih')->with('success', 'Kuesioner berhasil disubmit');
    }

    public function autosaveAnswer($kuesionerId)
    {
        if (!$this->request->isAJAX()) {
            return $this->failForbidden('Only AJAX requests are allowed');
        }

        $userId = session()->get('user_id');
        if (!$userId) {
            return $this->failUnauthorized('User not logged in');
        }

        $newAnswers = $this->request->getJSON(true)['answers'] ?? [];
        if (empty($newAnswers)) {
            return $this->fail('No answer data received');
        }

        try {
            $this->kuesionerAnswerModel->saveAnswers($kuesionerId, $userId, $newAnswers, 'draft');
            return $this->respond(['success' => true, 'message' => 'Jawaban berhasil disimpan']);
        } catch (\Exception $e) {
            return $this->failServerError('Error saving answer: ' . $e->getMessage());
        }
    }

    public function getAnswers($kuesionerId)
    {
        if (!$this->request->isAJAX()) {
            return $this->failForbidden('Only AJAX requests are allowed');
        }

        $userId = session()->get('user_id');
        if (!$userId) {
            return $this->failUnauthorized('User not logged in');
        }

        $answer = $this->kuesionerAnswerModel->getAnswerByUser($kuesionerId, $userId);

        return $this->respond([
            'success' => true,
            'answers' => $answer['answers'] ?? []
        ]);
    }

    public function terimakasih()
    {
        return view('kuesioner/terimakasih', ['title' => 'Terima Kasih']);
    }

    public function lihat_jawaban($kuesioner_id)
    {
        // Cek session login
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login');
        }

        // Load model
        $answerModel = new KuesionerAnswerModel();

        // Cari data jawaban
        $answer = $answerModel->where([
            'kuesioner_id' => $kuesioner_id,
            'user_id' => $user_id,
            'status' => 'submitted'
        ])->first();

        // Jika tidak ditemukan atau belum submitted
        if (!$answer) {
            return redirect()->to('/dashboard')->with('error', 'Data kuesioner tidak ditemukan atau belum disubmit');
        }

        // Decode JSON answers
        $answersData = json_decode($answer['answers'], true);

        // Format data menjadi array yang lebih sederhana
        $formattedAnswers = [];
        $this->flattenAnswers($answersData, $formattedAnswers);

        // Data untuk view
        $data = [
            'kuesioner' => [
                'id' => $answer['kuesioner_id'],
                'title' => 'Detail Jawaban Kuesioner' // Anda bisa ganti dengan judul asli dari database
            ],
            'answers' => $formattedAnswers
        ];

        return view('kuesioner/lihat_jawaban', $data);
    }

    /**
     * Helper method untuk flatten nested answers
     */
    private function flattenAnswers($data, &$result, $prefix = '')
    {
        foreach ($data as $key => $value) {
            $newKey = $prefix . $key;

            if (isset($value['question'])) {
                // Ini adalah level jawaban
                $result[] = [
                    'question' => $value['question'][0] ?? '',
                    'answer' => $value['answer'][0] ?? '',
                    'other_answer' => $value['other_answer'][0] ?? null
                ];
            } elseif (is_array($value)) {
                // Rekursif untuk nested array
                $this->flattenAnswers($value, $result, $newKey . ' → ');
            }
        }
    }


    public function updatePage($pageId)
    {
        if (!$this->request->isAJAX()) {
            return $this->failForbidden('Only AJAX requests are allowed');
        }

        $page = $this->kuesionerPageModel->find($pageId);
        if (!$page) {
            return $this->failNotFound('Halaman tidak ditemukan');
        }

        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'deskripsi' => 'permit_empty',
            'conditional_logic' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'conditional_logic' => $this->request->getPost('conditional_logic'),
            'updated_on' => date('Y-m-d H:i:s')
        ];

        try {
            if ($this->kuesionerPageModel->update($pageId, $data)) {
                return $this->respond([
                    'success' => true,
                    'message' => 'Halaman berhasil diperbarui',
                    'data' => $this->kuesionerPageModel->find($pageId)
                ]);
            }

            return $this->fail('Gagal memperbarui halaman');
        } catch (\Exception $e) {
            return $this->failServerError('Error: ' . $e->getMessage());
        }
    }

    public function deletePage($id)
    {
        // Check if this is an AJAX request
        $isAjax = $this->request->isAJAX();

        $page = $this->kuesionerPageModel->find($id);
        if (!$page) {
            if ($isAjax) {
                return $this->failNotFound('Halaman tidak ditemukan');
            }
            return redirect()->back()->with('error', 'Halaman tidak ditemukan');
        }

        try {
            // Hapus semua section dan field terkait
            $sections = $this->kuesionerSectionModel->where('page_id', $id)->findAll();
            foreach ($sections as $section) {
                $this->kuesionerFieldModel->where('section_id', $section['id'])->delete();
            }
            $this->kuesionerSectionModel->where('page_id', $id)->delete();

            if ($this->kuesionerPageModel->delete($id)) {
                // Update urutan halaman yang tersisa
                $this->kuesionerPageModel->updatePageOrdering($page['kuesioner_id']);

                if ($isAjax) {
                    return $this->respond([
                        'success' => true,
                        'message' => 'Halaman berhasil dihapus'
                    ]);
                }
                return redirect()->back()->with('success', 'Halaman berhasil dihapus');
            }

            if ($isAjax) {
                return $this->fail('Gagal menghapus halaman');
            }
            return redirect()->back()->with('error', 'Gagal menghapus halaman');
        } catch (\Exception $e) {
            if ($isAjax) {
                return $this->failServerError('Error: ' . $e->getMessage());
            }
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function getPageLogic($pageId)
    {
        $page = $this->kuesionerPageModel->find($pageId);
        if (!$page) {
            return $this->failNotFound('Halaman tidak ditemukan');
        }

        $logic = [];
        if (!empty($page['conditional_logic'])) {
            $logic = json_decode($page['conditional_logic'], true);
        }

        return $this->respond([
            'success' => true,
            'data' => $logic
        ]);
    }

    // API Endpoints untuk section
    public function addSection()
    {
        if (!$this->request->isAJAX()) {
            return $this->failForbidden('Only AJAX requests are allowed');
        }

        $rules = [
            'kuesioner_id' => 'required|numeric',
            'page_id' => 'required|numeric',
            'title' => 'required|min_length[3]|max_length[255]',
            'deskripsi' => 'permit_empty|max_length[500]'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $pageId = $this->request->getPost('page_id');

        $data = [
            'kuesioner_id' => $this->request->getPost('kuesioner_id'),
            'page_id' => $pageId,
            'title' => $this->request->getPost('title'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'ordering_count' => $this->kuesionerSectionModel->getNextOrderingCount($pageId),
            'created_on' => date('Y-m-d H:i:s'),
            'created_by' => session('user_id') ?? 1
        ];

        try {
            $sectionId = $this->kuesionerSectionModel->insert($data);

            if ($sectionId) {
                return $this->respond([
                    'success' => true,
                    'message' => 'Section berhasil ditambahkan',
                    'data' => $this->kuesionerSectionModel->find($sectionId)
                ]);
            }

            return $this->fail('Gagal menambahkan section');
        } catch (\Exception $e) {
            return $this->failServerError('Error: ' . $e->getMessage());
        }
    }

    public function updateSection($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->failForbidden('Only AJAX requests are allowed');
        }

        $section = $this->kuesionerSectionModel->find($id);
        if (!$section) {
            return $this->failNotFound('Section tidak ditemukan');
        }

        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'deskripsi' => 'permit_empty|max_length[500]'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'updated_on' => date('Y-m-d H:i:s')
        ];

        try {
            if ($this->kuesionerSectionModel->update($id, $data)) {
                return $this->respond([
                    'success' => true,
                    'message' => 'Section berhasil diperbarui',
                    'data' => $this->kuesionerSectionModel->find($id)
                ]);
            }

            return $this->fail('Gagal memperbarui section');
        } catch (\Exception $e) {
            return $this->failServerError('Error: ' . $e->getMessage());
        }
    }

    public function getPageSections($pageId)
    {
        try {
            $sections = $this->kuesionerSectionModel
                ->select('kuesioner_kuesioner_section.*, COUNT(kuesioner_fields.id) as question_count')
                ->join('kuesioner_fields', 'kuesioner_fields.section_id = kuesioner_kuesioner_section.id', 'left')
                ->where('kuesioner_kuesioner_section.page_id', $pageId) // Pastikan menggunakan nama tabel lengkap
                ->groupBy('kuesioner_kuesioner_section.id')
                ->orderBy('kuesioner_kuesioner_section.ordering_count', 'ASC')
                ->findAll();

            // Decode JSON fields for each section
            foreach ($sections as &$section) {
                if (!empty($section['conditional_logic'])) {
                    $section['conditional_logic'] = json_decode($section['conditional_logic'], true);
                }
            }

            return $this->respond([
                'success' => true,
                'data' => $sections
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error in getPageSections: ' . $e->getMessage());
            return $this->respond([
                'success' => false,
                'message' => 'Terjadi kesalahan server',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getSection($id)
    {
        $section = $this->kuesionerSectionModel->find($id);
        if (!$section) {
            return $this->failNotFound('Section tidak ditemukan');
        }

        // Decode JSON fields
        if (!empty($section['conditional_logic'])) {
            $section['conditional_logic'] = json_decode($section['conditional_logic'], true);
        } else {
            $section['conditional_logic'] = [];
        }

        if (!empty($section['section_options'])) {
            $section['section_options'] = json_decode($section['section_options'], true);
        }

        if (!empty($section['fields'])) {
            $section['fields'] = json_decode($section['fields'], true);
        }

        return $this->respond([
            'success' => true,
            'data' => $section
        ]);
    }

    public function deleteSection($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->failForbidden('Only AJAX requests are allowed');
        }

        $section = $this->kuesionerSectionModel->find($id);
        if (!$section) {
            return $this->failNotFound('Section tidak ditemukan');
        }

        try {
            // Hapus semua field terkait
            $this->kuesionerFieldModel->where('section_id', $id)->delete();

            if ($this->kuesionerSectionModel->delete($id)) {
                // Update urutan section yang tersisa
                $this->kuesionerSectionModel->updateSectionOrdering($section['page_id']);

                return $this->respond([
                    'success' => true,
                    'message' => 'Section berhasil dihapus'
                ]);
            }

            return $this->fail('Gagal menghapus section');
        } catch (\Exception $e) {
            return $this->failServerError('Error: ' . $e->getMessage());
        }
    }

    // API Endpoints untuk field/pertanyaan
    public function get_section_questions($sectionId)
    {
        try {
            $fields = $this->kuesionerFieldModel
                ->where('section_id', $sectionId)
                ->orderBy('ordering_count', 'ASC')
                ->findAll();

            $questions = array_map(function ($field) {
                $options = json_decode($field['options'] ?? '[]', true);

                // For scale questions, use the direct columns if available
                if ($field['type'] === 'scale') {
                    return [
                        'id' => $field['id'],
                        'section_id' => $field['section_id'],
                        'type' => $field['type'],
                        'label' => $field['label'],
                        'options' => $options,
                        'required' => $field['required'],
                        'note' => $field['note'],
                        'scale_min' => $field['scale_min'] ?? $options['min'] ?? 1,
                        'scale_max' => $field['scale_max'] ?? $options['max'] ?? 5,
                        'point_labels' => $field['point_labels'] ?? $options['labels'] ?? ''
                    ];
                }

                // For other question types
                return [
                    'id' => $field['id'],
                    'section_id' => $field['section_id'],
                    'type' => $field['type'],
                    'label' => $field['label'],
                    'options' => $options,
                    'required' => $field['required'],
                    'note' => $field['note']
                ];
            }, $fields);

            return $this->response->setJSON([
                'success' => true,
                'data' => $questions,
                'new_token' => csrf_hash()
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error in get_section_questions: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal memuat pertanyaan',
                'error' => $e->getMessage(),
                'new_token' => csrf_hash()
            ]);
        }
    }

    public function add_field()
    {
        try {
            $rules = [
                'section_id' => 'required|numeric',
                'type' => 'required',
                'label' => 'required|min_length[3]',
                'required' => 'permit_empty|in_list[0,1]'
            ];

            if ($this->request->getPost('type') === 'user_field') {
                $rules['options'] = 'required';
            }

            if (!$this->validate($rules)) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $this->validator->getErrors(),
                    'new_token' => csrf_hash()
                ]);
            }

            $sectionId = $this->request->getPost('section_id');
            $section = $this->kuesionerSectionModel->find($sectionId);

            if (!$section) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Section tidak ditemukan',
                    'new_token' => csrf_hash()
                ]);
            }

            $data = [
                'section_id' => $sectionId,
                'kuesioner_id' => $section['kuesioner_id'],
                'page_id' => $section['page_id'],
                'id_html' => random_int(100000, 999999),
                'type' => $this->request->getPost('type'),
                'label' => $this->request->getPost('label'),
                'required' => $this->request->getPost('required') ?? 0,
                'note' => $this->request->getPost('note'),
                'created_on' => date('Y-m-d H:i:s'),
                'created_by' => session('user_id') ?? 1
            ];

            switch ($data['type']) {
                case 'scale':
                    $min = (int) $this->request->getPost('min_scale') ?? 1;
                    $max = (int) $this->request->getPost('max_scale') ?? 5;

                    if ($min < 1) throw new \Exception('Nilai minimum tidak boleh kurang dari 1');
                    if ($max > 100) throw new \Exception('Nilai maksimum tidak boleh lebih dari 100');
                    if ($max <= $min) throw new \Exception('Nilai maksimum harus lebih besar dari minimum');

                    $labels = $this->request->getPost('point_labels') ?? '';
                    $labelCount = $labels ? count(explode(',', $labels)) : 0;

                    if ($labels && $labelCount !== ($max - $min + 1)) {
                        throw new \Exception('Jumlah label harus sama dengan range nilai (max - min + 1)');
                    }

                    $data['options'] = json_encode([
                        'min' => $min,
                        'max' => $max,
                        'labels' => $labels ? explode(',', $labels) : []
                    ]);
                    break;

                case 'dropdown':
                case 'checkbox':
                case 'radio':
                    $options = json_decode($this->request->getPost('options'), true);

                    if (!is_array($options)) {
                        throw new \Exception('Format opsi tidak valid');
                    }

                    // Buat array baru yang hanya menyimpan opsi jika label tidak kosong
                    $filteredOptions = [];
                    foreach ($options as $opt) {
                        if (!empty($opt['label'])) {
                            $filteredOptions[] = [
                                'label' => $opt['label'],
                                'value' => $opt['value'] ?? $opt['label'] // fallback: gunakan label jika value kosong
                            ];
                        }
                    }

                    $data['options'] = json_encode($filteredOptions, JSON_UNESCAPED_UNICODE);
                    break;


                case 'user_field':
                    $options = $this->request->getPost('options');
                    $data['options'] = json_encode([$options]);
                    break;

                case 'grid':
                    $rows = json_decode($this->request->getPost('grid_rows'), true) ?? [];
                    $cols = json_decode($this->request->getPost('grid_cols'), true) ?? [];

                    if (count($rows) < 1 || count($cols) < 1) {
                        throw new \Exception('Grid harus memiliki minimal 1 baris dan 1 kolom');
                    }

                    $data['options'] = json_encode([
                        'rows' => $rows,
                        'columns' => $cols
                    ], JSON_UNESCAPED_UNICODE);
                    break;

                default:
                    $data['options'] = json_encode([]);
            }

            $fieldId = $this->kuesionerFieldModel->insert($data);

            if (!$fieldId) {
                throw new \Exception('Gagal menyimpan pertanyaan ke database');
            }

            $newField = $this->kuesionerFieldModel->find($fieldId);

            return $this->respond([
                'success' => true,
                'message' => 'Pertanyaan berhasil ditambahkan',
                'data' => $this->processFieldData($newField),
                'new_token' => csrf_hash()
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error in add_field: ' . $e->getMessage());
            return $this->respond([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'new_token' => csrf_hash()
            ], 400);
        }
    }


    public function update_field($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->respond([
                'success' => false,
                'message' => 'Only AJAX requests are allowed',
                'new_token' => csrf_hash()
            ], 403);
        }

        $field = $this->kuesionerFieldModel->find($id);
        if (!$field) {
            return $this->respond([
                'success' => false,
                'message' => 'Field tidak ditemukan',
                'new_token' => csrf_hash()
            ], 404);
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'label' => 'required|min_length[3]',
            'type' => 'required',
            'required' => 'permit_empty|in_list[0,1]',
            'note' => 'permit_empty'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->respond([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validation->getErrors(),
                'new_token' => csrf_hash()
            ], 400);
        }

        try {
            $data = [
                'label' => $this->request->getPost('label'),
                'type' => $this->request->getPost('type'),
                'required' => $this->request->getPost('required') ?? 0,
                'note' => $this->request->getPost('note'),
                'updated_on' => date('Y-m-d H:i:s')
            ];

            $type = $this->request->getPost('type');
            if ($type === 'scale') {
                $min = (int)$this->request->getPost('min_scale') ?? 1;
                $max = (int)$this->request->getPost('max_scale') ?? 5;

                if ($min < 1) throw new \Exception('Nilai minimum tidak boleh kurang dari 1');
                if ($max > 100) throw new \Exception('Nilai maksimum tidak boleh lebih dari 100');
                if ($max <= $min) throw new \Exception('Nilai maksimum harus lebih besar dari minimum');

                $labels = $this->request->getPost('point_labels') ?? '';
                $labelCount = $labels ? count(explode(',', $labels)) : 0;

                if ($labels && $labelCount !== ($max - $min + 1)) {
                    throw new \Exception('Jumlah label harus sama dengan range nilai (max - min + 1)');
                }

                $data['options'] = json_encode([
                    'min' => $min,
                    'max' => $max,
                    'point_labels' => $labels
                ]);
            } elseif (in_array($type, ['dropdown', 'checkbox', 'radio'])) {
                $options = json_decode($this->request->getPost('options'), true);
                if (!is_array($options)) {
                    throw new \Exception('Format opsi tidak valid');
                }
                $data['options'] = json_encode($options);
            } elseif ($type === 'user_field') {
                $options = $this->request->getPost('options');
                $data['options'] = json_encode([$options]);
            } elseif ($type === 'grid') {
                $rows = json_decode($this->request->getPost('grid_rows'), true) ?? [];
                $cols = json_decode($this->request->getPost('grid_cols'), true) ?? [];

                if (count($rows) < 1 || count($cols) < 1) {
                    throw new \Exception('Grid harus memiliki minimal 1 baris dan 1 kolom');
                }

                $data['options'] = json_encode([
                    'rows' => $rows,
                    'columns' => $cols
                ], JSON_UNESCAPED_UNICODE);
            }

            $this->kuesionerFieldModel->update($id, $data);
            $updatedField = $this->kuesionerFieldModel->find($id);

            return $this->respond([
                'success' => true,
                'message' => 'Pertanyaan berhasil diperbarui',
                'data' => $this->processFieldData($updatedField),
                'new_token' => csrf_hash()
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error updating field: ' . $e->getMessage());
            return $this->respond([
                'success' => false,
                'message' => 'Gagal memperbarui pertanyaan: ' . $e->getMessage(),
                'new_token' => csrf_hash()
            ], 400);
        }
    }

    protected function processFieldData($field)
    {
        if (is_array($field) || is_object($field)) {
            if (isset($field['options'])) {
                $field['options'] = json_decode($field['options'], true);

                // Untuk tipe scale, tambahkan min dan max ke root object
                if (isset($field['type']) && $field['type'] === 'scale' && is_array($field['options'])) {
                    $field['min_scale'] = $field['options']['min'] ?? 1;
                    $field['max_scale'] = $field['options']['max'] ?? 5;
                    $field['point_labels'] = $field['options']['point_labels'] ?? '';
                }

                // Untuk tipe grid, tambahkan rows dan columns
                if (isset($field['type']) && $field['type'] === 'grid' && is_array($field['options'])) {
                    $field['grid_rows'] = $field['options']['rows'] ?? [];
                    $field['grid_columns'] = $field['options']['columns'] ?? [];
                }
            }
        }
        return $field;
    }


    public function get_field($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Only AJAX requests are allowed',
                'new_token' => csrf_hash()
            ]);
        }

        $field = $this->kuesionerFieldModel->find($id);
        if (!$field) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Field tidak ditemukan',
                'new_token' => csrf_hash()
            ]);
        }

        if (!empty($field['options'])) {
            $decoded = json_decode($field['options'], true);

            // Cek apakah hasil decode adalah array dengan satu string yang masih berbentuk JSON
            if (is_array($decoded) && count($decoded) === 1 && is_string($decoded[0])) {
                $decoded2 = json_decode($decoded[0], true);
                if (is_array($decoded2)) {
                    $field['options'] = $decoded2;
                } else {
                    $field['options'] = $decoded; // fallback ke hasil decode pertama
                }
            } else {
                $field['options'] = $decoded;
            }
        } else {
            $field['options'] = [];
        }


        if ($field['type'] === 'scale') {
            // Tambahkan nilai min dan max dari kolom atau dari options
            $field['scale_min'] = isset($field['scale_min']) && $field['scale_min'] !== null
                ? (int) $field['scale_min']
                : (isset($field['options']['min']) ? (int) $field['options']['min'] : 1);

            $field['scale_max'] = isset($field['scale_max']) && $field['scale_max'] !== null
                ? (int) $field['scale_max']
                : (isset($field['options']['max']) ? (int) $field['options']['max'] : 5);

            // Tangani label skala
            if (!empty($field['point_labels'])) {
                $field['point_labels'] = is_array($field['point_labels'])
                    ? $field['point_labels']
                    : array_map('trim', explode(',', $field['point_labels']));
            } elseif (isset($field['options']['labels']) && is_array($field['options']['labels'])) {
                $field['point_labels'] = $field['options']['labels'];
            } else {
                $field['point_labels'] = [];
            }
        }


        return $this->response->setJSON([
            'success' => true,
            'data' => $field,
            'new_token' => csrf_hash()
        ]);
    }

    public function delete_field($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Only AJAX requests are allowed',
                'new_token' => csrf_hash()
            ]);
        }

        $field = $this->kuesionerFieldModel->find($id);
        if (!$field) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Field tidak ditemukan',
                'new_token' => csrf_hash()
            ]);
        }

        try {
            $this->kuesionerFieldModel->delete($id);
            $this->updateFieldOrdering($field['section_id']);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Field berhasil dihapus',
                'new_token' => csrf_hash()
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error deleting field: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menghapus field: ' . $e->getMessage(),
                'new_token' => csrf_hash()
            ]);
        }
    }

    protected function updateFieldOrdering($sectionId)
    {
        $fields = $this->kuesionerFieldModel
            ->where('section_id', $sectionId)
            ->orderBy('ordering_count', 'ASC')
            ->findAll();

        $order = 1;
        foreach ($fields as $field) {
            $this->kuesionerFieldModel->update($field['id'], ['ordering_count' => $order]);
            $order++;
        }
    }

    //conditional logic 
    public function getUserFields()
    {
        $db = \Config\Database::connect();
        $fields = $db->getFieldNames('users');

        // Kolom yang ingin disembunyikan
        $excluded = ['password', 'reset_token', 'created_at', 'updated_at']; // bisa disesuaikan

        // Filter kolom yang aman ditampilkan
        $filteredFields = array_filter($fields, function ($field) use ($excluded) {
            return !in_array($field, $excluded);
        });

        return $this->response->setJSON(array_values($filteredFields)); // reset index array
    }

    public function getValuesForField($field)
    {
        $result = [];

        if ($field === 'program_studi') {
            $result = $this->db->table('organizations')
                ->select('name')
                ->where('tipe', 'Program Studi')
                ->groupBy('name')
                ->get()
                ->getResultArray();

            $result = array_column($result, 'name');
        } elseif ($field === 'jurusan') {
            $result = $this->db->table('organizations')
                ->select('name')
                ->where('tipe', 'Jurusan')
                ->groupBy('name')
                ->get()
                ->getResultArray();

            $result = array_column($result, 'name');
        } elseif ($field === 'angkatan') {
            $currentYear = date('Y');
            for ($i = $currentYear; $i >= $currentYear - 10; $i--) {
                $result[] = $i;
            }
        } elseif ($field === 'tahun_kelulusan') {
            $currentYear = date('Y');
            for ($i = $currentYear; $i >= $currentYear - 10; $i--) {
                $result[] = $i;
            }
        } elseif ($field === 'jenis_kelamin') {
            $result = ['L', 'P'];
        } elseif ($field === 'status') {
            $result = ['active', 'inactive'];
        } elseif ($field === 'role') {
            $result = ['site_admin', 'admin_jurusan', 'alumni'];
        }

        return $this->response->setJSON($result);
    }

    // In your controller
    public function getSectionsByStatus()
    {
        $selectedStatus = $this->request->getGet('status');
        $relevantSections = $this->getRelevantSections($selectedStatus);

        return $this->response->setJSON($relevantSections);
    }

    private function getRelevantSections($selectedStatus)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM kuesioner_kuesioner_section ORDER BY ordering_count");
        $allSections = $query->getResultArray();

        $relevantSections = [];

        foreach ($allSections as $section) {
            $options = json_decode($section['section_options'], true);

            if (!is_array($options)) {
                continue;
            }

            // Check if section is for all or matches selected status
            if (!empty($options['show_for_all']) && $options['show_for_all'] === true) {
                $relevantSections[] = $section;
            } elseif (isset($options['status']) && $options['status'] === $selectedStatus) {
                $relevantSections[] = $section;
            }
        }

        return $relevantSections;
    }
}
