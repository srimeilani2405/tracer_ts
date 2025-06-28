<?php

namespace App\Controllers;

use App\Models\TypeModel;
use CodeIgniter\Controller;

class TypeController extends Controller
{
    public function index()
    {
        $model = new TypeModel();
        $data['types'] = $model->findAll();
        return view('organization/types', $data);
    }

    public function add()
    {
        return view('organization/add_type');
    }

    public function store()
    {
        $model = new TypeModel();
        $model->insert([
            'name' => $this->request->getPost('name'),
            'level' => $this->request->getPost('level'),
            'description' => $this->request->getPost('description'),
            'available_group' => $this->request->getPost('available_group')
        ]);
        return redirect()->to('/organisasi/types');
    }

    public function edit($id)
    {
        $model = new TypeModel();
        $data['type'] = $model->find($id);
        return view('organization/edit_type', $data);
    }

    public function update($id)
    {
        $model = new TypeModel();
        $model->update($id, [
            'name' => $this->request->getPost('name'),
            'level' => $this->request->getPost('level'),
            'description' => $this->request->getPost('description'),
            'available_group' => $this->request->getPost('available_group')
        ]);
        return redirect()->to('/organisasi/types');
    }

    public function delete($id)
    {
        $model = new TypeModel();
        $model->delete($id);
        return redirect()->to('/organisasi/types');
    }
}
