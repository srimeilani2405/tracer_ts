<?php

namespace App\Controllers;

use App\Models\NavigationModel;

class NavigationController extends BaseController
{
    public function index()
    {
        $model = new NavigationModel();
        $data['links'] = $model->findAll();

        return view('admin/navigation/index', $data);
    }

    public function create()
    {
        return view('admin/navigation/create');
    }

    public function store()
    {
        $model = new NavigationModel();
        $model->insert([
            'label' => $this->request->getPost('label'),
            'url'   => $this->request->getPost('url')
        ]);

        return redirect()->to('/admin/navigation');
    }

    public function edit($id)
    {
        $model = new NavigationModel();
        $data['link'] = $model->find($id);

        return view('admin/navigation/edit', $data);
    }

    public function update($id)
    {
        $model = new NavigationModel();
        $model->update($id, [
            'label' => $this->request->getPost('label'),
            'url'   => $this->request->getPost('url')
        ]);

        return redirect()->to('/admin/navigation');
    }

    public function delete($id)
    {
        $model = new NavigationModel();
        $model->delete($id);

        return redirect()->to('/admin/navigation');
    }
}
