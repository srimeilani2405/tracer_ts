<?php

use App\Controllers\UserController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/admin', 'Admin::index');
$routes->get('/welcomepage', 'WelcomeController::index');
$routes->get('/welcome', 'WelcomeController::index');
$routes->post('/welcome/save', 'WelcomeController::save');
$routes->get('/login', 'Auth::login');
$routes->post('/auth/login', 'Auth::processLogin');
$routes->get('/logout', 'Auth::logout');
$routes->get('tracer/home', 'Home::index');
$routes->group('tracer-study', function ($routes) {
    $routes->get('/', 'TracerStudy::index');
    $routes->get('tentang', 'TracerStudy::tentang');
    $routes->get('kontak', 'TracerStudy::kontak');
});

$routes->get('/contacts', 'ContactController::index');
$routes->get('/contacts/create', 'ContactController::create');
$routes->post('/contacts/store', 'ContactController::store');
$routes->get('/contacts/edit/(:num)', 'ContactController::edit/$1');
$routes->post('/contacts/update/(:num)', 'ContactController::update/$1');
$routes->post('/contacts/delete/(:num)', 'ContactController::delete/$1');
$routes->get('/contacts/getAlumniByTahun', 'ContactController::getAlumniByTahun');
$routes->get('/contacts/getAlumniDetail', 'ContactController::getAlumniDetail');

$routes->get('/pages', 'PageController::index');
$routes->get('/pages/create', 'PageController::create');
$routes->post('/pages/store', 'PageController::store');
$routes->get('/pages/edit/(:num)', 'PageController::edit/$1');
$routes->post('/pages/update/(:num)', 'PageController::update/$1');
$routes->post('/pages/delete/(:num)', 'PageController::delete/$1');
$routes->post('/pages/toggle/(:num)', 'PageController::toggleActive/$1');

// Route berdasarkan role
$routes->get('/welcomepage', 'Welcome::index'); // site_admin dan admin
$routes->get('admin_jurusan/dashboard', 'AdminJurusanController::dashboard');
$routes->get('alumni/dashboard', 'AlumniController::dashboard');

$routes->get('profile', 'Auth::profile');
$routes->get('/profile', 'ProfileController::index');
$routes->get('/profile/edit/(:num)', 'ProfileController::edit/$1');
$routes->post('/profile/edit/(:num)', 'ProfileController::update/$1');
$routes->post('/profile/update', 'ProfileController::update');

// Route untuk Admin
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Admin::index'); // Halaman utama admin (welcome)
    $routes->get('student-data', 'Admin::studentData');
    $routes->get('reports', 'Admin::reports');
    $routes->get('settings', 'Admin::settings');
    $routes->get('edit-welcome', 'Admin::editWelcome');
    $routes->get('kuesioner', 'Admin::kuesioner');
});

$routes->get('/admin/navigation', 'NavigationController::index');
$routes->get('/admin/navigation/create', 'NavigationController::create');
$routes->post('/admin/navigation/store', 'NavigationController::store');
$routes->get('/admin/navigation/edit/(:num)', 'NavigationController::edit/$1');
$routes->post('/admin/navigation/update/(:num)', 'NavigationController::update/$1');
$routes->get('/admin/navigation/delete/(:num)', 'NavigationController::delete/$1');

// Route untuk Alumni
// $routes->get('/alumni/home', 'Alumni::index', ['filter' => 'auth']);

// Route untuk Surveyor
$routes->get('/surveyor/home', 'Surveyor::index', ['filter' => 'auth']);
$routes->get('/admin/surveyor', 'SurveyorController::index');
$routes->get('/admin/surveyor/set/(:num)', 'SurveyorController::setSurveyor/$1');

$routes->get('kuesioner/isi/(:num)', 'KuesionerController::isi/$1');
$routes->post('kuesioner/submit/(:num)', 'KuesionerController::submit/$1');
$routes->get('kuesioner/terimakasih', 'KuesionerController::terimakasih');
$routes->post('kuesioner/autosave/(:num)', 'KuesionerController::autosaveAnswer/$1');
$routes->get('kuesioner/get-answers/(:num)', 'KuesionerController::getAnswers/$1');
$routes->get('kuesioner/lihat_jawaban/(:num)', 'KuesionerController::lihat_jawaban/$1');

$routes->group('Kuesioner', function ($routes) {
    $routes->get('/', 'KuesionerController::index');
    $routes->get('index', 'KuesionerController::index');
    $routes->get('tambah', 'KuesionerController::tambah');
    $routes->post('simpan', 'KuesionerController::simpan');
    $routes->get('edit/(:num)', 'KuesionerController::edit/$1');
    $routes->post('update', 'KuesionerController::update');
    $routes->delete('delete/(:num)', 'KuesionerController::delete/$1');
    $routes->post('toggle_status/(:num)', 'KuesionerController::toggleStatus/$1');
    $routes->post('clone/(:num)', 'KuesionerController::clone/$1');
    $routes->get('lihat-data-isian/(:num)', 'KuesionerController::lihatDataIsian/$1');
    $routes->get('tinjau_kuesioner/(:num)', 'KuesionerController::tinjau_kuesioner/$1');
    $routes->get('unduh/(:num)', 'KuesionerController::unduh/$1');



    // Page Management
    $routes->get('get_pages/(:num)', 'KuesionerController::getPages/$1');
    $routes->post('add_page', 'KuesionerController::addPage');
    $routes->post('updatePage/(:num)', 'KuesionerController::updatePage/$1'); // Diubah dari put ke post
    $routes->delete('delete_page/(:num)', 'KuesionerController::deletePage/$1');
    $routes->get('get_page_logic/(:num)', 'KuesionerController::getPageLogic/$1');

    // Section Management
    $routes->post('add_section', 'KuesionerController::addSection');
    $routes->post('update_section/(:num)', 'KuesionerController::updateSection/$1'); // Diubah dari put ke post
    $routes->delete('delete_section/(:num)', 'KuesionerController::deleteSection/$1');
    $routes->get('get_page_sections/(:num)', 'KuesionerController::getPageSections/$1');
    $routes->get('get_section/(:num)', 'KuesionerController::getSection/$1');
    $routes->get('get_section_questions/(:num)', 'KuesionerController::get_section_questions/$1');

    // Fields Managemennt
    $routes->post('add_field', 'KuesionerController::add_field');
    $routes->get('get_field/(:num)', 'KuesionerController::get_field/$1');
    $routes->delete('delete_field/(:num)', 'KuesionerController::delete_field/$1');
    $routes->post('update_field/(:num)', 'KuesionerController::update_field/$1');
    $routes->get('user-fields', 'UserFieldController::index');
});



// Routes: app/Config/Routes.php
$routes->get('/users', 'UserController::index');
$routes->get('/users/create', 'UserController::create');
$routes->post('/users/store', 'UserController::store');
$routes->get('/users/edit/(:num)', 'UserController::edit/$1');
$routes->post('users/update/(:num)', 'UserController::update/$1');
$routes->put('users/update/(:num)', 'UserController::update/$1');
$routes->get('/users/delete/(:num)', 'UserController::delete/$1');
$routes->get('/get-programs/(:num)', 'UserController::getPrograms/$1');

// Routes untuk Site Admin
$routes->get('/site_admin', 'SiteAdminController::index');
$routes->get('/site_admin/add', 'SiteAdminController::add');
$routes->get('admin_jurusan/getJurusan', 'AdminJurusanController::getJurusan');
$routes->post('/site_admin/store', 'SiteAdminController::store');
$routes->get('/site_admin/edit/(:num)', 'SiteAdminController::edit/$1');
$routes->post('/site_admin/update/(:num)', 'SiteAdminController::update/$1');
$routes->get('/site_admin/delete/(:num)', 'SiteAdminController::delete/$1');
$routes->get('/site_admin/import', 'SiteAdminController::import');
$routes->post('/site_admin/prosesImport', 'SiteAdminController::prosesImport');
$routes->get('/site_admin/download-template', 'SiteAdminController::downloadTemplate');

// Routes untuk Alumni
$routes->get('/alumni', 'AlumniController::index');
$routes->get('/alumni/add', 'AlumniController::add');
$routes->post('alumni/store', 'AlumniController::store');
$routes->get('/alumni/edit/(:num)', 'AlumniController::edit/$1');
$routes->post('/alumni/update/(:num)', 'AlumniController::update/$1');
$routes->get('/alumni/delete/(:num)', 'AlumniController::delete/$1');
$routes->post('/alumni/simpan', 'AlumniController::simpan');
$routes->get('/alumni/import', 'AlumniController::import'); // Route untuk halaman import
$routes->post('/alumni/prosesImport', 'AlumniController::prosesImport'); // Route un
$routes->get('alumni/download-template', 'AlumniController::downloadTemplate');
$routes->get('get-program-studi/(:num)', 'AlumniController::getProgramStudiByJurusan/$1');

// Routes untuk Admin Jurusan
$routes->get('/admin_jurusan', 'AdminJurusanController::index');
$routes->get('/admin_jurusan/add', 'AdminJurusanController::add');
$routes->post('/admin_jurusan/store', 'AdminJurusanController::store');
$routes->get('/admin_jurusan/edit/(:num)', 'AdminJurusanController::edit/$1');
$routes->post('/admin_jurusan/update/(:num)', 'AdminJurusanController::update/$1');
$routes->get('/admin_jurusan/delete/(:num)', 'AdminJurusanController::delete/$1');
$routes->get('/admin_jurusan/import', 'AdminJurusanController::import');
$routes->post('/admin_jurusan/prosesImport', 'AdminJurusanController::prosesImport');
$routes->get('/admin_jurusan/download-template', 'AdminJurusanController::downloadTemplate');

$routes->get('/pengaturan', 'SettingsController::index');
$routes->post('/pengaturan/simpan', 'SettingsController::simpan');
$routes->post('/pengaturan/update', 'SettingsController::update');

$routes->group('organisasi', function ($routes) {
    $routes->get('/', 'OrganizationController::index'); // Halaman utama organisasi
    $routes->get('units/(:segment)', 'OrganizationController::index/$1');
    $routes->get('units', 'OrganizationController::units'); // Halaman Satuan Organisasi
    $routes->get('units/view/(:num)', 'OrganizationController::view/$1'); // Halaman detail satuan organisasi
    $routes->get('types', 'TypeController::index'); // Halaman Tipe Organisasi


    // Rute untuk CRUD Organisasi
    $routes->get('create', 'OrganizationController::create'); // Form tambah organisasi
    $routes->post('store', 'OrganizationController::store'); // Proses tambah organisasi
    $routes->get('edit/(:num)', 'OrganizationController::edit/$1'); // Form edit organisasi
    $routes->post('update/(:num)', 'OrganizationController::update/$1'); // Proses edit organisasi
    $routes->get('delete/(:num)', 'OrganizationController::delete/$1'); // Hapus organisasi

    // Rute untuk Tipe Organisasi
    $routes->get('types/add', 'TypeController::add'); // Form tambah tipe organisasi
    $routes->post('types/store', 'TypeController::store'); // Proses tambah tipe organisasi
    $routes->get('types/edit/(:num)', 'TypeController::edit/$1'); // Form edit tipe organisasi
    $routes->post('types/update/(:num)', 'TypeController::update/$1'); // Proses edit tipe organisasi
    $routes->get('types/delete/(:num)', 'TypeController::delete/$1'); // Hapus tipe organisasi
});

$routes->group('jurusan', function ($routes) {
    $routes->get('/', 'JurusanController::index');  // Menampilkan daftar jurusan
    $routes->get('create', 'JurusanController::create'); // Form tambah jurusan
    $routes->post('store', 'JurusanController::store'); // Proses simpan jurusan baru
    $routes->get('edit/(:num)', 'JurusanController::edit/$1'); // Form edit jurusan berdasarkan ID
    $routes->post('update/(:num)', 'JurusanController::update/$1'); // Proses update jurusan berdasarkan ID
    $routes->get('delete/(:num)', 'JurusanController::delete/$1'); // Hapus jurusan berdasarkan ID
    $routes->get('tinjau/(:num)', 'JurusanController::tinjau/$1'); // Menampilkan detail jurusan
});

$routes->group('program_studi', function ($routes) {
    $routes->get('/', 'ProgramStudiController::index'); // Menampilkan daftar program studi
    $routes->get('create', 'ProgramStudiController::create'); // Form tambah program studi
    $routes->post('store', 'ProgramStudiController::store'); // Proses simpan program studi baru
    $routes->get('edit/(:num)', 'ProgramStudiController::edit/$1'); // Form edit program studi berdasarkan ID
    $routes->post('update/(:num)', 'ProgramStudiController::update/$1'); // Proses update program studi berdasarkan ID
    $routes->get('delete/(:num)', 'ProgramStudiController::delete/$1'); // Hapus program studi berdasarkan ID
    $routes->get('tinjau/(:num)', 'ProgramStudiController::tinjau/$1');
});

// Conditional Logic
$routes->get('get-user-fields', 'KuesionerController::getUserFields');
$routes->get('kuesioner/get-values-for-field/(:segment)', 'KuesionerController::getValuesForField/$1');
$routes->get('/get-options/(:segment)', 'KuesionerController::getOptions/$1');
