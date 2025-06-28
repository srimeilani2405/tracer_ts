<?php

namespace App\Controllers;

use App\Models\TracerStudyModel;
use App\Models\TracerContactModel;
use App\Models\WelcomeModel;
use App\Models\PageModel;

class TracerStudy extends BaseController
{
    protected $tracerStudyModel;
    protected $tracerContactModel;
    protected $pageModel;
    protected $welcomeModel;

    public function __construct()
    {
        $this->tracerStudyModel = new TracerStudyModel();
        $this->tracerContactModel = new TracerContactModel();
        $this->pageModel = new PageModel();
        $this->welcomeModel = new WelcomeModel();
    }

    public function index()
    {
        $data['welcomeMessage'] = $this->welcomeModel->getWelcomeMessage();
        return view('tracer/home', $data);
    }

    public function tentang()
    {
        $aboutPages = $this->pageModel->getAboutPages();
        $data = [
            'title' => 'Tentang Kami',
            'active_menu' => 'tentang',
            'aboutPages' => $aboutPages
        ];
        return view('tracer/tentang', $data);
    }

    public function kontak()
{
    $contactContent = $this->tracerStudyModel->where('section', 'contact')->first();
    $directorate = $this->tracerContactModel->getDirectorContact();
    $team = $this->tracerContactModel->getContactsByType('team');
    $addressInfo = $this->tracerContactModel->getAddressInfo();

    // Ambil tahun terbaru dari data surveyor atau koordinator
    $latestYear = $this->tracerContactModel->selectMax('tahun')->first()['tahun'] ?? date('Y');
    
    // Get data surveyor dan koordinator
    $surveyors = $this->tracerContactModel->where('contact_type', 'surveyor')
        ->orderBy('program_studi', 'asc')
        ->orderBy('name', 'asc')
        ->findAll();

    $coordinators = $this->tracerContactModel->where('contact_type', 'coordinator')
        ->orderBy('jurusan', 'asc')
        ->orderBy('name', 'asc')
        ->findAll();

    $data = [
        'title' => 'Tracer Study - Kontak',
        'active_menu' => 'kontak',
        'directorate' => $directorate,
        'team' => $team,
        'addressInfo' => $addressInfo,
        'surveyors' => $surveyors,
        'coordinators' => $coordinators,
        'contactContent' => $contactContent['content'] ?? '',
        'currentYear' => $latestYear // Tambahkan ini
    ];

    return view('tracer/kontak', $data);
}
    public function home()
    {
        $data = [
            'title' => 'Tracer Study - Home',
            'active_menu' => 'home'
        ];
        return view('tracer/home', $data);
    }
}
