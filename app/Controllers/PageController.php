<?php

namespace App\Controllers;

use App\Models\PageModel;
use App\Models\ContactModel;

class PageController extends BaseController
{
    protected $pageModel;
    protected $contactModel;

    public function __construct()
    {
        $this->pageModel = new PageModel();
        $this->contactModel = new ContactModel();
    }

    // Halaman admin - list halaman dan kontak
    public function index()
    {
        helper('text');
        $data = [
            'pages' => $this->pageModel->findAll(),
            'contacts' => $this->contactModel->findAll()
        ];
        return view('pages/index', $data);
    }

    public function create()
    {
        return view('pages/create');
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'title' => 'required|min_length[3]|max_length[255]',
            'content' => 'required'
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->pageModel->save([
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'section' => 'about'
        ]);

        return redirect()->to('/pages')->with('success', 'Halaman berhasil dibuat');
    }

    public function edit($id)
    {
        $page = $this->pageModel->find($id);
        if (!$page) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('pages/edit', ['page' => $page]);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'title' => 'required|min_length[3]|max_length[255]',
            'content' => 'required'
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->pageModel->update($id, [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'section' => 'about'
        ]);

        return redirect()->to('/pages')->with('success', 'Halaman berhasil diperbarui');
    }

    public function delete($id)
    {
        $page = $this->pageModel->find($id);
        if (!$page) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if (in_array($page['section'], ['about', 'contact'])) {
            cache()->delete($page['section'] . '_page_content');
        }

        $this->pageModel->delete($id);
        return redirect()->to('/pages')->with('success', 'Halaman berhasil dihapus');
    }

    public function toggleActive($id)
    {
        $page = $this->pageModel->find($id);
        if (!$page) {
            return $this->response->setJSON(['success' => false]);
        }

        $isActive = !$page['is_active'];
        $this->pageModel->update($id, ['is_active' => $isActive]);

        return $this->response->setJSON([
            'success' => true,
            'is_active' => $isActive
        ]);
    }

    public function publicPages()
    {
        $data = [
            'pages' => $this->pageModel->getActivePages()
        ];
        return view('public_pages', $data);
    }

    public function getPageBySlug($slug)
    {
        $slug = strtolower($slug);

        return $this->pageModel
            ->where('LOWER(REPLACE(title, " ", "-")) =', $slug, false)
            ->first();
    }
}
