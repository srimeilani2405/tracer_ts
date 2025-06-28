<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Surveyor extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Surveyor',
        ];
        return view('surveyor/home', $data);
    }
}