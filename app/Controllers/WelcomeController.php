<?php
// app/Controllers/WelcomeController.php

namespace App\Controllers;

use App\Models\WelcomeModel;

class WelcomeController extends BaseController
{
    public function index()
    {
        $model = new WelcomeModel();
        $data['welcomeMessage'] = $model->getWelcomeMessage();

        return view('welcomepage', $data);
    }

    public function save()
    {
        $model = new WelcomeModel();
        $message = $this->request->getPost('welcomeMessage');

        $model->saveMessage($message);

        return redirect()->to('/welcome');
    }
}
