<?php

namespace App\Controllers;

use App\Models\NavigationModel;
use App\Models\WelcomeModel;

class Home extends BaseController
{
    public function index()
    {
        $navModel = new NavigationModel();
        $welcomeModel = new WelcomeModel();

        $data['links'] = $navModel->where('is_active', 1)->findAll();
        $data['welcomeMessage'] = $welcomeModel->getWelcomeMessage();

        return view('tracer/home', $data);
    }
}
