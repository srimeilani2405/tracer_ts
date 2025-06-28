<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracer Study - Admin Panel</title>
    <meta name="csrf-token" content="<?= csrf_token() ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Main Layout Styles */

        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }

        nav h4 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .logo {
            display: block;
            width: 100px;
            height: 100px;
            margin: 0 auto 15px;
        }

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav ul li {
            margin: 12px 0;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            display: flex;
            align-items: center;
            padding: 12px;
            border-radius: 8px;
            transition: 0.3s;
            font-size: 16px;
        }

        nav ul li a:hover {
            background-color: #575757;
            color: #ffcc00;
        }

        .submenu {
            list-style: none;
            padding-left: 20px;
            display: none;
        }

        .toggle-submenu {
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
        }

        .arrow {
            transition: transform 0.3s ease;
        }

        .arrow.rotate {
            transform: rotate(90deg);
        }

        /* Card Styles */
        .card-page {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .card-page .card-header {
            background-color: #f8f9fa;
            padding: 10px 15px;
        }

        /* Button Styles */
        .btn-save {
            background-color: #4e73df;
            color: white;
            border: none;
            padding: 8px 20px;
            font-weight: bold;
            border-radius: 6px;
            transition: 0.3s;
        }

        .btn-save:hover {
            background-color: #3752b3;
        }

        .btn-cancel {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 8px 20px;
            font-weight: bold;
            border-radius: 6px;
            transition: 0.3s;
        }

        .btn-cancel:hover {
            background-color: #5a6268;
        }

        /* Conditional Logic Styles */
        .logic-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .action-link {
            color: #4e73df;
            text-decoration: none;
            margin-left: 10px;
        }

        .action-link.delete {
            color: #dc3545;
        }

        .conditional-logic-container {
            display: none;
            margin-top: 15px;
            padding: 15px;
            background-color: #f0f0f0;
            border-radius: 5px;
        }

        /* Section Management Styles */
        .section-management {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .section-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .section-table th,
        .section-table td {
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            text-align: left;
        }

        .section-table th {
            background-color: #4e73df;
            color: white;
        }

        .section-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .section-table tr:hover {
            background-color: #e9ecef;
        }

        .section-actions {
            display: flex;
            gap: 5px;
        }

        .section-actions .btn {
            padding: 5px 10px;
            font-size: 12px;
        }

        /* Breadcrumb Styles */
        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 20px;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: ">";
        }

        /* Question Builder Styles */
        .question-builder {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }

        .question-preview {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .question-type-selector {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }

        .question-type-option {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s;
            font-size: 14px;
        }

        .question-type-option:hover {
            background-color: #f0f7ff;
            border-color: #4e73df;
        }

        .question-type-option.active {
            background-color: #4e73df;
            color: white;
            border-color: #4e73df;
        }

        .question-form {
            margin-top: 20px;
        }

        .option-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .option-item input {
            flex-grow: 1;
            margin-right: 10px;
        }

        .option-item .remove-option {
            color: #dc3545;
            cursor: pointer;
        }

        .questions-list {
            margin-top: 30px;
        }

        .question-item {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .question-item .question-text {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .question-item .question-type {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .question-actions {
            position: absolute;
            top: 15px;
            right: 15px;
        }

        .question-actions .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }

        /* Edit Section Specific Styles */
        .edit-section-container {
            margin-top: 20px;
        }

        .section-header {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .section-description {
            color: #6c757d;
            margin-bottom: 15px;
        }

        .section-settings {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 15px;
        }

        .form-check {
            padding-left: 1.5em;
        }

        /* Question Preview Styles */
        .question-preview {
            margin-top: 15px;
            padding: 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            background-color: #f8f9fa;
        }

        .form-check {
            margin-bottom: 8px;
        }

        /* Scale question specific styles */
        .scale-options {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 15px 0;
            margin-top: 10px;
        }

        .scale-options .form-check {
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 40px;
        }

        .scale-options .form-check-input {
            width: 22px;
            height: 22px;
            margin-right: 0;
            margin-bottom: 8px;
            cursor: pointer;
        }

        .scale-options .form-check-label {
            font-size: 0.85rem;
            text-align: center;
            word-break: break-word;
            max-width: 60px;
        }

        /* Style untuk grid */
        .rating-option {
            position: relative;
            width: 100%;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .rating-option input[type="radio"] {
            display: none;
        }

        .rating-option label {
            display: inline-block;
            width: 20px;
            height: 20px;
            line-height: 18px;
            border-radius: 50%;
            border: 1.5px solid #666;
            text-align: center;
            cursor: pointer;
            font-size: 14px;
            user-select: none;
            transition: all 0.2s ease-in-out;
        }

        .rating-option input[type="radio"]:checked+label {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .question-label {
            text-align: left;
            font-weight: 500;
        }

        /* Simpan Perubahan & Batal */
        .btn-cancel {
            background-color: #6c757d !important;
            /* abu-abu */
            color: white !important;
            border: none;
        }

        .btn-save {
            background-color: #007bff !important;
            /* biru */
            color: white !important;
            border: none;
        }
    </style>
</head>

<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>

<div class="main-content">
    <!-- Tab Daftar Kuesioner -->
    <div id="daftar-tab">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Kuesioner</h2>
            <a href="<?= base_url('Kuesioner/tambah') ?>" class="btn btn-primary">+ Tambah Kuesioner</a>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <!-- <th>Deskripsi</th> -->
                    <th>Conditional Logic</th> <!-- Tambahan kolom -->
                    <th>Entries</th>
                    <th>Aktif</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($kuesioner) && is_array($kuesioner)) : ?>
                    <?php foreach ($kuesioner as $index => $row) : ?>
                        <?php
                        $isActive = $row['active'] === 'Ya';
                        $btnText = $isActive ? 'Deactivate' : 'Activate';
                        $btnClass = $isActive ? 'btn-danger' : 'btn-success';
                        ?>
                        <tr id="kuesioner-<?= esc($row['id']) ?>">
                            <td><?= $index + 1 ?></td>
                            <td><?= esc($row['title']) ?></td>
                            <!-- <td><?= esc($row['deskripsi']) ?></td> -->
                            <td><?= esc($row['conditional_logic'] ?? '-') ?></td>
                            <td><?= esc($row['entries'] ?? 0) ?> <a href="<?= base_url('Kuesioner/lihat-data-isian/' . $row['id']) ?>">Lihat</a></td>
                            <td><?= $isActive ? 'Ya' : '-' ?></td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm edit-kuesioner"
                                    data-id="<?= $row['id'] ?>"
                                    data-title="<?= esc($row['title']) ?>"
                                    data-deskripsi="<?= esc($row['deskripsi']) ?>"
                                    data-conditional="<?= esc($row['conditional_logic']) ?>">
                                    Edit
                                </a>

                               <button type="button" class="btn btn-sm toggle-status <?= $btnClass ?>"
        data-id="<?= $row['id'] ?>"
        data-active="<?= $isActive ? 'Ya' : '-' ?>">
    <?= $btnText ?>
</button>


                                <a href="<?= base_url('kuesioner/tinjau_kuesioner/' . $row['id']) ?>" class="btn btn-primary btn-sm">
                                    Tinjau
                                </a>

                                <button class="btn btn-success btn-sm btn-clone" data-id="<?= $row['id'] ?>">Clone</button>

                                <a href="<?= base_url('Kuesioner/unduh/' . $row['id']) ?>" class="btn btn-dark btn-sm">
                                    Unduh
                                </a>

                                <button class="btn btn-danger btn-sm btn-delete" data-id="<?= $row['id'] ?>">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data kuesioner</td>
                    </tr>
                <?php endif; ?>

            </tbody>

        </table>
    </div>

    <!-- Tab Sunting Kuesioner -->
    <div id="sunting-tab" style="display: none;">
        <button type="button" class="btn btn-secondary mb-3" id="kembali-button">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </button>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Sunting Kuesioner</h4>
            <button type="button" class="btn btn-primary" id="tambah-halaman">
                <i class="fas fa-plus"></i> Tambah Halaman
            </button>
        </div>

        <div class="form-section">
            <form id="form-sunting" method="post" action="<?= base_url('Kuesioner/update') ?>">
                <input type="hidden" id="edit-id" name="id">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="edit-title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="edit-title" name="title" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="edit-deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="edit-deskripsi" name="deskripsi" rows="3" required></textarea>
                    </div>
                </div>
                <!-- Sesi Conditional Logic -->
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="enable-conditional-logic">
                        <label class="form-check-label" for="enable-conditional-logic">
                            Conditional Logic
                        </label>
                    </div>

                    <div class="conditional-logic-container" id="kuesioner-logic-container" style="display: none;">
                        <div class="logic-row d-flex align-items-center gap-2 mb-2">
                            <!-- Dropdown Field -->
                            <select class="form-select form-select-sm user-field-select" style="width: 150px;"></select>

                            <!-- Dropdown Operator -->
                            <select class="form-select form-select-sm logic-operator" style="width: 100px;">
                                <option value="is">is</option>
                                <option value="is_not">is not</option>
                            </select>

                            <!-- Input atau dropdown value akan ditampilkan di sini oleh JS -->
                            <div class="value-container" style="width: 200px;">
                                <input type="text" class="form-control form-control-sm logic-value-input" name="value" placeholder="Isi nilai">
                            </div>

                            <!-- Tombol Add/Remove Logic -->
                            <a href="#" class="btn btn-sm btn-outline-primary add-logic"><i class="fas fa-plus"></i> Add</a>
                            <a href="#" class="btn btn-sm btn-outline-danger remove-logic d-none"><i class="fas fa-minus"></i> Remove</a>
                        </div>
                    </div>

                    <!-- Hidden input untuk menyimpan hasil logic sebagai string JSON -->
                    <input type="hidden" name="conditional_logic" id="conditional-logic-input">
                </div>

                <div class="action-buttons mt-4">
                    <button type="button" class="btn btn-cancel" id="batal-edit">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="button" class="btn btn-save" id="simpan-perubahan">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <div class="table-section mt-5">
            <h5>Daftar Halaman</h5>
            <div class="table-responsive">
                <table class="table table-bordered" id="pages-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Halaman</th>
                            <th>Deskripsi</th>
                            <th>Conditional Logic</th>
                            <th>Jumlah Section</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data halaman akan dimuat di sini -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tab Edit Halaman -->
    <div id="edit-page-tab" style="display: none;">
        <div class="breadcrumb">
            <span class="breadcrumb-item">Home</span>
            <span class="breadcrumb-item">Daftar Kuesioner</span>
            <span class="breadcrumb-item">Kuesioner 2017</span>
            <span class="breadcrumb-item active">Halaman 1</span>
        </div>

        <button type="button" class="btn btn-secondary mb-3" id="kembali-edit-page">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Halaman
        </button>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Sunting Kuesioner Page</h4>
        </div>

        <div class="form-section">
            <form id="form-edit-page">
                <input type="hidden" id="edit-page-id" name="id">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="edit-page-title" class="form-label">Judul Halaman*</label>
                        <input type="text" class="form-control" id="edit-page-title" name="title" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="edit-page-deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="edit-page-deskripsi" name="deskripsi" rows="3"></textarea>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="edit-enable-logic">
                        <label class="form-check-label" for="edit-enable-logic">
                            Conditional Logic
                        </label>
                    </div>

                    <div class="conditional-logic-container" id="edit-logic-container" style="display: none;">
                        <!-- Logic rows akan ditambahkan di sini -->
                    </div>
                </div>

                <div class="action-buttons mt-4">
                    <button type="button" class="btn btn-cancel" id="batal-edit-page">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="button" class="btn btn-save" id="simpan-edit-page">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Section untuk menambahkan section baru -->
        <div class="section-management mt-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Daftar Section</h5>
                <button type="button" class="btn btn-primary" id="tambah-section">
                    <i class="fas fa-plus"></i> Tambah Section
                </button>
            </div>

            <div class="table-responsive">
                <table class="section-table" id="sections-table">
                    <thead>
                        <tr>
                            <th>Section ID</th>
                            <th>Section Name</th>
                            <th>Description</th>
                            <th>Conditional Logic</th>
                            <th>Num of Question</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data section akan dimuat di sini -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tab Edit Section -->
    <div id="edit-section-tab" style="display: none;">
        <div class="breadcrumb">
            <span class="breadcrumb-item">Home</span>
            <span class="breadcrumb-item">Daftar Kuesioner</span>
            <span class="breadcrumb-item">Kuesioner 2017</span>
            <span class="breadcrumb-item">Halaman 1</span>
            <span class="breadcrumb-item active">Data Pribadi</span>
        </div>

        <button type="button" class="btn btn-secondary mb-3" id="kembali-edit-section">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Section
        </button>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Sunting Kuesioner Section</h4>
        </div>

        <div class="form-section">
            <form id="form-edit-section">
                <input type="hidden" id="edit-section-id" name="id">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="edit-section-title" class="form-label">Judul Section</label>
                        <input type="text" class="form-control" id="edit-section-title" name="title" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="edit-section-deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="edit-section-deskripsi" name="deskripsi" rows="3"></textarea>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="edit-section-enable-logic">
                        <label class="form-check-label" for="edit-section-enable-logic">
                            Conditional Logic
                        </label>
                    </div>

                    <div class="conditional-logic-container" id="edit-section-logic-container" style="display: none;">
                        <!-- Logic rows akan ditambahkan di sini -->
                    </div>
                </div>

                <div class="action-buttons mt-4">
                    <button type="button" class="btn btn-cancel" id="batal-edit-section">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="button" class="btn btn-save" id="simpan-edit-section">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Question Builder -->
        <div class="question-builder">
            <h5>Pilih Jenis Pertanyaan...</h5>

            <div class="question-type-selector">
                <div class="question-type-option" data-type="text">
                    <div>Text</div>
                </div>
                <div class="question-type-option" data-type="email">
                    <div>Email</div>
                </div>
                <div class="question-type-option" data-type="dropdown">
                    <div>Dropdown</div>
                </div>
                <div class="question-type-option" data-type="date">
                    <div>Tanggal</div>
                </div>
                <div class="question-type-option" data-type="checkbox">
                    <div>Checkbox</div>
                </div>
                <div class="question-type-option" data-type="radio">
                    <div>Radio</div>
                </div>
                <div class="question-type-option" data-type="scale">
                    <div>Skala</div>
                </div>
                <div class="question-type-option" data-type="grid">
                    <div>Grid</div>
                </div>
                <div class="question-type-option" data-type="number">
                    <div>Angka</div>
                </div>
                <div class="question-type-option" data-type="phone">
                    <div>Telepon</div>
                </div>
                <div class="question-type-option" data-type="user_field" id="btnUserField">
                    <div>Data Pengguna</div>
                </div>
            </div>

            <!-- Question Form -->
            <form id="form-question">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                <input type="hidden" id="question-section-id" name="section_id">
                <input type="hidden" id="question-id" name="id">

                <div class="question-form" id="questionForm" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label">Label</label>
                        <div id="dynamicInputContainer"></div>
                    </div>

                    <div id="user-field-container" class="mb-3 mt-2" style="display: none;">
                        <label for="user_field">Pilih Field dari Data Pengguna</label>
                        <select name="options" id="user_field" class="form-select">
                            <option value="">Memuat data...</option>
                        </select>
                    </div>

                    <div class="mb-3" id="optionsContainer" style="display: none;">
                        <label class="form-label">Opsi Jawaban</label>
                        <div id="optionItems">
                            <!-- Options will be added here dynamically -->
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="addOption">
                            <i class="fas fa-plus"></i> Tambah Opsi
                        </button>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="isRequired" name="required" value="1">
                            <label class="form-check-label" for="isRequired">
                                Wajib diisi
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="note">Catatan (Opsional)</label>
                            <textarea id="questionNote" name="note" class="form-control" placeholder="Masukkan catatan untuk pertanyaan"></textarea>
                        </div>
                    </div>


                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary me-2" id="saveQuestion">Simpan Pertanyaan</button>
                        <button type="button" class="btn btn-outline-secondary" id="cancelQuestion">Batal</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Questions List -->
        <div class="questions-list">
            <h5>Pertanyaan dalam Section</h5>
            <!-- Questions will be loaded here -->
        </div>
    </div>
</div>
</div>

<!-- Modal Tambah Halaman -->
<div class="modal fade" id="addPageModal" tabindex="-1" aria-labelledby="addPageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPageModalLabel">Tambah Halaman Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-page-form">
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                    <div class="mb-3">
                        <label for="page-title" class="form-label">Judul Halaman*</label>
                        <input type="text" class="form-control" id="page-title" required>
                    </div>
                    <div class="mb-3">
                        <label for="page-deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="page-deskripsi" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="enable-page-logic">
                            <label class="form-check-label" for="enable-page-logic">
                                Aktifkan Conditional Logic untuk Halaman ini
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="button" class="btn btn-primary" id="simpan-halaman">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Section -->
<div class="modal fade" id="addSectionModal" tabindex="-1" aria-labelledby="addSectionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSectionModalLabel">Tambah Section Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-section-form">
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                    <input type="hidden" id="section-page-id" name="page_id">
                    <input type="hidden" id="section-id" name="id">
                    <div class="mb-3">
                        <label for="section-title" class="form-label">Judul Section</label>
                        <input type="text" class="form-control" id="section-title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="section-deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="section-deskripsi" name="deskripsi" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="button" class="btn btn-primary" id="simpan-section">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Pertanyaan -->
<div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addQuestionModalLabel">Tambah Pertanyaan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-question-form">
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                    <input type="hidden" id="question-section-id" name="section_id">
                    <input type="hidden" id="question-id" name="id">

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="question-text" class="form-label">Label Pertanyaan</label>
                            <input type="text" class="form-control" id="question-text" name="label" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="question-type" class="form-label">Tipe Pertanyaan</label>
                            <select class="form-select" id="question-type" name="type" required>
                                <option value="text">Single Line Text</option>
                                <option value="email">Email</option>
                                <option value="dropdown">Dropdown List</option>
                                <option value="date">Date</option>
                                <option value="checkbox">Checkboxes</option>
                                <option value="radio">Radio Buttons</option>
                                <option value="scale">Scale</option>
                                <option value="grid">Grid</option>
                                <option value="number">Number</option>
                                <option value="phone">Phone</option>
                                <option value="user_field">User Field</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="question-placeholder" class="form-label">Placeholder</label>
                            <input type="text" class="form-control" id="question-placeholder" name="placeholder">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="question-required" class="form-label">Wajib Diisi</label>
                            <select class="form-select" id="question-required" name="required">
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="options-container" id="options-container" style="display: none;">
                        <h6>Opsi Jawaban</h6>
                        <div class="option-items" id="option-items">
                            <!-- Opsi akan ditambahkan di sini -->
                        </div>
                        <button type="button" class="btn btn-sm btn-primary mt-2" id="add-option">
                            <i class="fas fa-plus"></i> Tambah Opsi
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="button" class="btn btn-primary" id="simpan-question">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<!-- Modal Konfirmasi Clone Universal -->
<div class="modal fade" id="confirmCloneModal" tabindex="-1" aria-labelledby="confirmCloneModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmCloneModalLabel">Konfirmasi Clone</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin meng-clone data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="#" id="cloneButton" class="btn btn-primary">Clone</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Fungsi untuk menampilkan notifikasi
    function showAlert(type, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        Toast.fire({
            icon: type,
            title: message
        });
    }

    function handleOtherInput(element, fieldId) {
        const otherInput = document.getElementById(`other_input_${fieldId}`);
        if (!otherInput) return;

        const selectedValue = element.value.toLowerCase();
        if (selectedValue === 'lainnya') {
            otherInput.style.display = 'block';
        } else {
            otherInput.style.display = 'none';
            otherInput.value = '';
        }
    }

    // Untuk checkbox
    function handleCheckboxOther(fieldId, value) {
        const otherInput = document.getElementById(`other_input_${fieldId}`);
        if (!otherInput) return;

        const checkboxes = document.querySelectorAll(`[id^="checkbox_${fieldId}_"]`);
        let showInput = false;

        checkboxes.forEach(cb => {
            if (cb.value.toLowerCase() === 'lainnya' && cb.checked) {
                showInput = true;
            }
        });

        if (showInput) {
            otherInput.style.display = 'block';
        } else {
            otherInput.style.display = 'none';
            otherInput.value = '';
        }
    }


    $(document).ready(function() {
        let currentEditingId = null;
        let currentPageId = null;
        let currentSectionId = null;
        let currentQuestionId = null;
        let currentQuestionType = null;

        // Initialize tabs
        $('#daftar-tab').show();
        $('#sunting-tab').hide();
        $('#edit-page-tab').hide();
        $('#edit-section-tab').hide();

        // Toggle organization submenu
        $('#toggleOrganisasi').click(function() {
            $(this).find('.arrow').toggleClass('rotate');
            $('#submenuOrganisasi').slideToggle();
        });

        // Conditional logic functions
        $('#enable-conditional-logic').change(function() {
            $('#kuesioner-logic-container').toggle($(this).is(':checked'));
        });

        $('#edit-enable-logic').change(function() {
            $('#edit-logic-container').toggle($(this).is(':checked'));
        });

        $('#edit-section-enable-logic').change(function() {
            $('#edit-section-logic-container').toggle($(this).is(':checked'));
        });



        // Fungsi Condtional Logic
        // Muat daftar field dari server
        function loadUserFieldsForLogicRow(selectElement) {
            $.ajax({
                url: '<?= base_url('get-user-fields') ?>',
                method: 'GET',
                success: function(fields) {
                    $(selectElement).empty().append(`<option value="">Pilih Field</option>`);
                    fields.forEach(function(field) {
                        const label = field.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                        $(selectElement).append(`<option value="${field}">${label}</option>`);
                    });
                    $(selectElement).trigger('loaded'); // penting untuk trigger setelah diisi
                }
            });
        }


        // Muat value input atau dropdown tergantung field
        function loadValueInput(fieldName, container) {
            const valueContainer = $(container);
            const dropdownFields = [
                'jurusan',
                'program_studi',
                'angkatan',
                'tahun_kelulusan',
                'jenis_kelamin',
                'status',
                'role'
            ];

            if (dropdownFields.includes(fieldName)) {
                $.ajax({
                    url: `<?= base_url('kuesioner/get-values-for-field') ?>/${fieldName}`,
                    method: 'GET',
                    success: function(data) {
                        let selectHTML = `<select class="form-select form-select-sm" name="value" style="width: 200px;">`;
                        selectHTML += `<option value="">Pilih ${fieldName.replace('_', ' ')}</option>`;
                        data.forEach(function(item) {
                            if (typeof item === 'object') {
                                // Kalau datanya bentuk {id, name}
                                selectHTML += `<option value="${item.id}">${item.name}</option>`;
                            } else {
                                // Kalau datanya cuma string
                                selectHTML += `<option value="${item}">${item}</option>`;
                            }
                        });
                        selectHTML += `</select>`;
                        valueContainer.html(selectHTML);
                    }
                });
            } else {
                valueContainer.html(`<input type="text" class="form-control form-control-sm" name="value" placeholder="Isi nilai">`);
            }
        }

        $(document).ready(function() {
            // Tampilkan/hidden conditional logic
            $('#enable-conditional-logic').on('change', function() {
                $('#kuesioner-logic-container').toggle(this.checked);
            });

            // Load field awal saat halaman ready
            loadUserFieldsForLogicRow('#kuesioner-logic-container .logic-row select.user-field-select:first');

            // Ubah value input saat field dipilih
            $('#kuesioner-logic-container').on('change', '.user-field-select', function() {
                const selectedField = $(this).val();
                const container = $(this).closest('.logic-row').find('.value-container');
                loadValueInput(selectedField, container);
            });

            // Tambah logic row
            $(document).on('click', '.add-logic', function(e) {
                e.preventDefault();
                const newLogicRow = `
            <div class="logic-row mb-2 d-flex align-items-center gap-2">
                <select class="form-select form-select-sm user-field-select" style="width: 150px;"></select>
                <select class="form-select form-select-sm logic-operator" style="width: 100px;">
                    <option value="is">is</option>
                    <option value="is_not">is not</option>
                </select>
                <div class="value-container" style="width: 200px;">
                    <input type="text" class="form-control form-control-sm" name="value" placeholder="Isi nilai">
                </div>
                <a href="#" class="btn btn-sm btn-outline-primary add-logic"><i class="fas fa-plus"></i> Add</a>
                <a href="#" class="btn btn-sm btn-outline-danger remove-logic"><i class="fas fa-minus"></i> Remove</a>
            </div>
        `;
                const $newRow = $(newLogicRow);
                $(this).closest('.logic-row').after($newRow);
                const $select = $newRow.find('.user-field-select');
                loadUserFieldsForLogicRow($select);
                $select.on('loaded', function() {
                    $select.trigger('change');
                });

            });

            // Hapus logic row
            $(document).on('click', '.remove-logic', function(e) {
                e.preventDefault();
                $(this).closest('.logic-row').remove();
            });
        });

        // Back from page edit
        $('#kembali-edit-page, #batal-edit-page').click(function() {
            $('#sunting-tab').show();
            $('#edit-page-tab').hide();
            $('#edit-section-tab').hide();
        });

        // Back from section edit
        $('#kembali-edit-section, #batal-edit-section').click(function() {
            $('#edit-page-tab').show();
            $('#edit-section-tab').hide();
        });

        document.getElementById('kembali-button').addEventListener('click', function() {
            document.getElementById('sunting-tab').style.display = 'none';
            document.getElementById('daftar-tab').style.display = 'block';
        });

        document.getElementById('batal-edit').addEventListener('click', function() {
            document.getElementById('sunting-tab').style.display = 'none';
            document.getElementById('daftar-tab').style.display = 'block';
        });


        // Edit questionnaire
        $(document).on('click', '.edit-kuesioner', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            const title = $(this).data('title');
            const deskripsi = $(this).data('deskripsi');

            currentEditingId = id;

            $('#edit-id').val(id);
            $('#edit-title').val(title);
            $('#edit-deskripsi').val(deskripsi);

            // Reset conditional logic
            $('#enable-conditional-logic').prop('checked', false);
            $('#kuesioner-logic-container').hide();

            // Load pages list
            loadPages(id);

            // Show edit tab
            $('#daftar-tab').hide();
            $('#sunting-tab').show();
            $('#edit-page-tab').hide();
            $('#edit-section-tab').hide();
        });

        // Load pages function
        function loadPages(questionnaireId) {
            $.ajax({
                url: '<?= base_url('Kuesioner/get_pages/') ?>' + questionnaireId,
                type: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function(response) {
                    $('#pages-table tbody').empty();
                    if (response.success && response.data && response.data.length > 0) {
                        response.data.forEach((page, index) => {
                            const row = `
                                <tr data-id="${page.id}">
                                    <td>${index + 1}</td>
                                    <td>${page.title}</td>
                                    <td>${page.deskripsi || '-'}</td>
                                    <td>${page.conditional_logic ? 'Ya' : 'Tidak'}</td>
                                    <td>${page.section_count || 0}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary btn-edit-page" 
                                            data-id="${page.id}" 
                                            data-title="${page.title}" 
                                            data-deskripsi="${page.deskripsi || ''}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-sm btn-danger btn-delete-page" data-id="${page.id}">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            `;
                            $('#pages-table tbody').append(row);
                        });
                    } else {
                        $('#pages-table tbody').append(
                            '<tr><td colspan="6" class="text-center">Belum ada halaman</td></tr>'
                        );
                    }
                },
                error: function(xhr) {
                    console.error(xhr);
                    let errorMsg = 'Gagal memuat halaman';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    alert(errorMsg);
                }
            });
        }

        // Add new page
        $('#tambah-halaman').click(function() {
            resetPageForm();
            $('#addPageModal').modal('show');
        });

        $('#simpan-halaman').click(function() {
            const title = $('#page-title').val();
            const deskripsi = $('#page-deskripsi').val();
            const hasLogic = $('#enable-page-logic').is(':checked');

            if (!title) {
                alert('Judul halaman harus diisi');
                return;
            }

            ///data koleksi conditional logic
            const logicRules = [];

            $('.logic-row').each(function() {
                const row = $(this);
                const field = row.find('select.user-field-select').val();
                const condition = row.find('select.logic-operator').val();

                // Ambil value dari input atau select
                let value = row.find('input[name="value"]').val();
                if (!value) {
                    value = row.find('select[name="value"]').val();
                }

                if (field && condition && value) {
                    logicRules.push({
                        field: field,
                        condition: condition,
                        value: value
                    });
                }
            });


            const url = '<?= base_url('Kuesioner/add_page') ?>';
            const data = {
                kuesioner_id: currentEditingId,
                title: title,
                deskripsi: deskripsi,
                conditional_logic: hasLogic ? JSON.stringify(logicRules) : null,
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            };

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#addPageModal').modal('hide');
                        loadPages(currentEditingId);
                        resetPageForm();
                    } else {
                        alert(response.message || 'Gagal menyimpan halaman');
                    }
                },
                error: function(xhr) {
                    console.error(xhr);
                    let errorMsg = 'Terjadi kesalahan saat menyimpan halaman';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    alert(errorMsg);
                }
            });
        });

        // Reset page form
        function resetPageForm() {
            $('#page-title').val('');
            $('#page-deskripsi').val('');
            $('#enable-page-logic').prop('checked', false);
            $('.conditional-logic-container').empty();
            $('.conditional-logic-container').append(`
                <div class="logic-row mb-2 d-flex align-items-center gap-2">
                    <select class="form-select form-select-sm" style="width: 150px;">
                        <option value="academic_program">Academic Program</option>
                        <option value="academic_faculty">Academic Faculty</option>
                    </select>
                    <select class="form-select form-select-sm" style="width: 100px;">
                        <option value="is">is</option>
                        <option value="is_not">is not</option>
                    </select>
                    <input type="text" class="form-control form-control-sm" style="width: 200px;" placeholder="Jurusan/Prodi">
                    <a href="#" class="btn btn-sm btn-outline-primary add-logic"><i class="fas fa-plus"></i> Add</a>
                </div>
            `);
            $('.conditional-logic-container').hide();
            $('#addPageModalLabel').text('Tambah Halaman Baru');
        }

        // Edit page
        $(document).on('click', '.btn-edit-page', function() {
            currentPageId = $(this).data('id');
            const title = $(this).data('title');
            const deskripsi = $(this).data('deskripsi');

            // Update breadcrumb
            $('.breadcrumb .active').text(title);

            $('#edit-page-title').val(title);
            $('#edit-page-deskripsi').val(deskripsi || '');

            // Load conditional logic if exists
            $.ajax({
                url: `<?= base_url('Kuesioner/get_page_logic/') ?>${currentPageId}`,
                type: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function(response) {
                    const logicContainer = $('#edit-logic-container');
                    logicContainer.empty();

                    if (response.success && response.data && response.data.length > 0) {
                        $('#edit-enable-logic').prop('checked', true);
                        logicContainer.show();

                        // Add logic rows based on data
                        response.data.forEach((logic, index) => {
                            const logicRow = `
                                <div class="logic-row mb-2 d-flex align-items-center gap-2">
                                    <select class="form-select form-select-sm" style="width: 150px;">
                                        <option value="academic_program" ${logic.field === 'academic_program' ? 'selected' : ''}>Academic Program</option>
                                        <option value="academic_faculty" ${logic.field === 'academic_faculty' ? 'selected' : ''}>Academic Faculty</option>
                                    </select>
                                    <select class="form-select form-select-sm" style="width: 100px;">
                                        <option value="is" ${logic.condition === 'is' ? 'selected' : ''}>is</option>
                                        <option value="is_not" ${logic.condition === 'is_not' ? 'selected' : ''}>is not</option>
                                    </select>
                                    <input type="text" class="form-control form-control-sm" style="width: 200px;" placeholder="Jurusan/Prodi" value="${logic.value || ''}">
                                    <a href="#" class="btn btn-sm btn-outline-primary add-logic"><i class="fas fa-plus"></i> Add</a>
                                    ${index > 0 ? '<a href="#" class="btn btn-sm btn-outline-danger remove-logic"><i class="fas fa-minus"></i> Remove</a>' : ''}
                                </div>
                            `;
                            logicContainer.append(logicRow);
                        });
                    } else {
                        $('#edit-enable-logic').prop('checked', false);
                        logicContainer.hide();
                        // Add empty row
                        logicContainer.append(`
                            <div class="logic-row mb-2 d-flex align-items-center gap-2">
                                <select class="form-select form-select-sm" style="width: 150px;">
                                    <option value="academic_program">Academic Program</option>
                                    <option value="academic_faculty">Academic Faculty</option>
                                </select>
                                <select class="form-select form-select-sm" style="width: 100px;">
                                    <option value="is">is</option>
                                    <option value="is_not">is not</option>
                                </select>
                                <input type="text" class="form-control form-control-sm" style="width: 200px;" placeholder="Jurusan/Prodi">
                                <a href="#" class="btn btn-sm btn-outline-primary add-logic"><i class="fas fa-plus"></i> Add</a>
                            </div>
                        `);
                    }

                    // Load sections for this page
                    loadPageSections(currentPageId);

                    // Show page edit tab
                    $('#sunting-tab').hide();
                    $('#edit-page-tab').show();
                    $('#edit-section-tab').hide();
                },
                error: function(xhr) {
                    console.error(xhr);
                    alert('Gagal memuat data halaman');
                }
            });
        });

        // Save page edit
       $('#simpan-edit-page').click(function () {
    const title = $('#edit-page-title').val();
    const deskripsi = $('#edit-page-deskripsi').val();
    const hasLogic = $('#edit-enable-logic').is(':checked');

    if (!currentPageId) {
        Swal.fire('Error!', 'ID halaman tidak ditemukan.', 'error');
        return;
    }

    if (!title) {
        Swal.fire('Oops!', 'Judul halaman harus diisi.', 'warning');
        return;
    }

    // Collect conditional logic
    const logicRules = [];
    $('.logic-row').each(function () {
        const row = $(this);
        const field = row.find('select:eq(0)').val();
        const condition = row.find('select:eq(1)').val();
        const value = row.find('input').val();

        if (field && condition && value) {
            logicRules.push({
                field: field,
                condition: condition,
                value: value
            });
        }
    });

    const url = '<?= base_url('Kuesioner/updatePage/') ?>' + currentPageId;
    const data = {
        title: title,
        deskripsi: deskripsi,
        conditional_logic: hasLogic ? JSON.stringify(logicRules) : null,
        <?= csrf_token() ?>: '<?= csrf_hash() ?>'
    };

    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Halaman berhasil diperbarui.',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    loadPages(currentEditingId);
                    $('#sunting-tab').show();
                    $('#edit-page-tab').hide();
                    $('#edit-section-tab').hide();
                });
            } else {
                Swal.fire('Gagal!', response.message || 'Gagal memperbarui halaman.', 'error');
                if (response.errors) {
                    console.error('Validation errors:', response.errors);
                }
            }
        },
        error: function (xhr) {
            console.error(xhr);
            let errorMsg = 'Terjadi kesalahan saat memperbarui halaman';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMsg = xhr.responseJSON.message;
            }
            Swal.fire('Error!', errorMsg, 'error');
        }
    });
});


        // Delete page with SweetAlert2
        $(document).on('click', '.btn-delete-page', function() {
            const pageId = $(this).data('id');

            Swal.fire({
                title: 'Yakin ingin menghapus halaman ini?',
                text: "Halaman dan semua pertanyaan di dalamnya akan dihapus.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `<?= base_url('Kuesioner/delete_page/') ?>${pageId}`,
                        type: 'DELETE',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Terhapus!',
                                    text: 'Halaman berhasil dihapus.',
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                                loadPages(currentEditingId);
                            } else {
                                Swal.fire('Gagal!', response.message || 'Gagal menghapus halaman.', 'error');
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr);
                            let errorMsg = 'Terjadi kesalahan saat menghapus halaman';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMsg = xhr.responseJSON.message;
                            }
                            Swal.fire('Error!', errorMsg, 'error');
                        }
                    });
                }
            });
        });

        // Load sections function
        function loadPageSections(pageId) {
            $.ajax({
                url: `<?= base_url('Kuesioner/get_page_sections/') ?>${pageId}`,
                type: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function(response) {
                    const container = $('#sections-table tbody');
                    container.empty();

                    if (response.success && response.data && response.data.length > 0) {
                        response.data.forEach((section, index) => {
                            container.append(`
                        <tr data-id="${section.id}">
                            <td>${index + 1}</td> <!-- Nomor urut yang benar -->
                            <td>${section.title}</td>
                            <td>${section.deskripsi || '-'}</td>
                            <td>${section.conditional_logic ? 'Ya' : 'Tidak'}</td>
                            <td>${section.question_count || 0}</td>
                            <td class="section-actions">
                                <button class="btn btn-sm btn-primary edit-section" 
                                    data-id="${section.id}"
                                    data-title="${section.title}"
                                    data-deskripsi="${section.deskripsi || ''}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger delete-section" data-id="${section.id}">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                    `);
                        });
                    } else {
                        container.append('<tr><td colspan="6" class="text-center">Belum ada section</td></tr>');
                    }
                },
                error: function(xhr) {
                    console.error(xhr);
                    alert('Gagal memuat sections');
                }
            });
        }
        // Show add section modal
        $('#tambah-section').click(function() {
            currentSectionId = null;
            $('#section-title').val('');
            $('#section-deskripsi').val('');
            $('#section-page-id').val(currentPageId);
            $('#addSectionModalLabel').text('Tambah Section Baru');
            $('#addSectionModal').modal('show');
        });

        // Show edit section in tab
        $(document).on('click', '.edit-section', function() {
            currentSectionId = $(this).data('id');
            const title = $(this).data('title');
            const deskripsi = $(this).data('deskripsi');

            // Update breadcrumb
            $('.breadcrumb .active').text(title);

            $('#edit-section-title').val(title);
            $('#edit-section-deskripsi').val(deskripsi || '');

            // Load conditional logic if exists
            $.ajax({
                url: `<?= base_url('Kuesioner/get_section/') ?>${currentSectionId}`,
                type: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function(response) {
                    const logicContainer = $('#edit-section-logic-container');
                    logicContainer.empty();

                    if (response.success && response.data && response.data.length > 0) {
                        $('#edit-section-enable-logic').prop('checked', true);
                        logicContainer.show();

                        // Add logic rows based on data
                        response.data.forEach((logic, index) => {
                            const logicRow = `
                                <div class="logic-row mb-2 d-flex align-items-center gap-2">
                                    <select class="form-select form-select-sm" style="width: 150px;">
                                        <option value="academic_program" ${logic.field === 'academic_program' ? 'selected' : ''}>Academic Program</option>
                                        <option value="academic_faculty" ${logic.field === 'academic_faculty' ? 'selected' : ''}>Academic Faculty</option>
                                    </select>
                                    <select class="form-select form-select-sm" style="width: 100px;">
                                        <option value="is" ${logic.condition === 'is' ? 'selected' : ''}>is</option>
                                        <option value="is_not" ${logic.condition === 'is_not' ? 'selected' : ''}>is not</option>
                                    </select>
                                    <input type="text" class="form-control form-control-sm" style="width: 200px;" placeholder="Jurusan/Prodi" value="${logic.value || ''}">
                                    <a href="#" class="btn btn-sm btn-outline-primary add-logic"><i class="fas fa-plus"></i> Add</a>
                                    ${index > 0 ? '<a href="#" class="btn btn-sm btn-outline-danger remove-logic"><i class="fas fa-minus"></i> Remove</a>' : ''}
                                </div>
                            `;
                            logicContainer.append(logicRow);
                        });
                    } else {
                        $('#edit-section-enable-logic').prop('checked', false);
                        logicContainer.hide();
                        // Add empty row
                        logicContainer.append(`
                            <div class="logic-row mb-2 d-flex align-items-center gap-2">
                                <select class="form-select form-select-sm" style="width: 150px;">
                                    <option value="academic_program">Academic Program</option>
                                    <option value="academic_faculty">Academic Faculty</option>
                                </select>
                                <select class="form-select form-select-sm" style="width: 100px;">
                                    <option value="is">is</option>
                                    <option value="is_not">is not</option>
                                </select>
                                <input type="text" class="form-control form-control-sm" style="width: 200px;" placeholder="Jurusan/Prodi">
                                <a href="#" class="btn btn-sm btn-outline-primary add-logic"><i class="fas fa-plus"></i> Add</a>
                            </div>
                        `);
                    }

                    // Load questions for this section
                    loadSectionFields(currentSectionId);

                    // Show section edit tab
                    $('#edit-page-tab').hide();
                    $('#edit-section-tab').show();
                },
                error: function(xhr) {
                    console.error(xhr);
                    alert('Gagal memuat data section');
                }
            });
        });

        function loadSectionsBasedOnStatus(selectedStatus) {
            fetch(`/api/sections?status=${encodeURIComponent(selectedStatus)}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(sections => {
                    const container = document.getElementById('kuesioner-container');
                    if (!container) {
                        console.error('Container element not found');
                        return;
                    }

                    container.innerHTML = '';

                    sections.forEach(section => {
                        try {
                            const options = JSON.parse(section.section_options);
                            const sectionHTML = `
                        <div class="section" data-section-id="${section.id}">
                            <h3>${options.display_name || section.title}</h3>
                            ${renderFields(options.fields || [])}
                        </div>
                    `;
                            container.insertAdjacentHTML('beforeend', sectionHTML);
                        } catch (error) {
                            console.error('Error parsing section options:', error, section);
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching sections:', error);
                });
        }

        // Panggil fungsi saat status berubah
        document.addEventListener('DOMContentLoaded', () => {
            const statusSelect = document.getElementById('status_saat_ini');
            if (statusSelect) {
                statusSelect.addEventListener('change', function() {
                    loadSectionsBasedOnStatus(this.value);
                });
            } else {
                console.error('Status select element not found');
            }
        });

        // Fungsi untuk menampilkan modal notifikasi
function showNotifModal(pesan, isError = false) {
    $('#notifModalLabel').text(isError ? 'Kesalahan' : 'Informasi');
    $('#notifModal .modal-header').removeClass('bg-info bg-danger')
        .addClass(isError ? 'bg-danger' : 'bg-info');
    $('#notifModalBody').html(pesan);
    $('#notifModal').modal('show');
}

// Simpan section baru
$('#simpan-section').click(function () {
    const title = $('#section-title').val();
    const deskripsi = $('#section-deskripsi').val();

    if (!currentPageId) {
        showNotifModal('ID halaman tidak ditemukan.', true);
        return;
    }

    if (!title) {
        showNotifModal('Judul section harus diisi', true);
        return;
    }

    const data = {
        kuesioner_id: currentEditingId,
        page_id: currentPageId,
        title: title,
        deskripsi: deskripsi,
        <?= csrf_token() ?>: '<?= csrf_hash() ?>'
    };

    const url = currentSectionId ?
        '<?= base_url('Kuesioner/update_section/') ?>' + currentSectionId :
        '<?= base_url('Kuesioner/add_section') ?>';

    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                $('#addSectionModal').modal('hide');
                loadPageSections(currentPageId);
                showNotifModal(response.message || 'Section berhasil disimpan');
            } else {
                showNotifModal(response.message || 'Gagal menyimpan section', true);
                if (response.errors) {
                    console.error('Validation errors:', response.errors);
                }
            }
        },
        error: function (xhr) {
            console.error(xhr);
            let errorMsg = 'Terjadi kesalahan saat menyimpan section';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMsg = xhr.responseJSON.message;
            }
            showNotifModal(errorMsg, true);
        }
    });
});

// Simpan edit section dari tab
$('#simpan-edit-section').click(function () {
    const title = $('#edit-section-title').val();
    const deskripsi = $('#edit-section-deskripsi').val();
    const hasLogic = $('#edit-section-enable-logic').is(':checked');

    if (!currentSectionId) {
        showNotifModal('ID section tidak ditemukan.', true);
        return;
    }

    if (!title) {
        showNotifModal('Judul section harus diisi', true);
        return;
    }

    const logicRules = [];

    $('.logic-row').each(function () {
        const row = $(this);
        const field = row.find('select.user-field-select').val();
        const condition = row.find('select.logic-operator').val();
        let value = row.find('input[name="value"]').val();
        if (!value) {
            value = row.find('select[name="value"]').val();
        }

        if (field && condition && value) {
            logicRules.push({
                ShowIf: field,
                condition: condition,
                value: value
            });
        }
    });

    const url = '<?= base_url('Kuesioner/update_section/') ?>' + currentSectionId;
    const data = {
        title: title,
        deskripsi: deskripsi,
        conditional_logic: hasLogic ? JSON.stringify(logicRules) : null,
        <?= csrf_token() ?>: '<?= csrf_hash() ?>'
    };

    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                showNotifModal('Section berhasil diperbarui');
                loadPageSections(currentPageId);
                $('#edit-page-tab').show();
                $('#edit-section-tab').hide();
            } else {
                showNotifModal(response.message || 'Gagal memperbarui section', true);
                if (response.errors) {
                    console.error('Validation errors:', response.errors);
                }
            }
        },
        error: function (xhr) {
            console.error(xhr);
            let errorMsg = 'Terjadi kesalahan saat memperbarui section';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMsg = xhr.responseJSON.message;
            }
            showNotifModal(errorMsg, true);
        }
    });
});

        // Delete section with SweetAlert2
        $(document).on('click', '.delete-section', function() {
            const sectionId = $(this).data('id');

            Swal.fire({
                title: 'Yakin ingin menghapus section ini?',
                text: "Semua pertanyaan dalam section ini juga akan ikut dihapus.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `<?= base_url('Kuesioner/delete_section/') ?>${sectionId}`,
                        type: 'DELETE',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Terhapus!',
                                    text: 'Section berhasil dihapus.',
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                                loadPageSections(currentPageId);
                            } else {
                                Swal.fire('Gagal!', response.message || 'Gagal menghapus section.', 'error');
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr);
                            let errorMsg = 'Terjadi kesalahan saat menghapus section';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMsg = xhr.responseJSON.message;
                            }
                            Swal.fire('Error!', errorMsg, 'error');
                        }
                    });
                }
            });
        });


        // Question Builder Functionality
        $('.question-type-option').click(function() {
            $('.question-type-option').removeClass('active');
            $(this).addClass('active');

            currentQuestionType = $(this).data('type');
            $('#questionForm').show();

            // Reset semua fields
            $('#isRequired').prop('checked', false).next('label').find('.text-danger').remove();
            $('#optionsContainer').hide();
            $('#optionItems').empty();

            // Prepare input pertanyaan (label) dinamis
            let inputHTML = '';

            switch (currentQuestionType) {
                case 'text':
                    inputHTML = `
                <div class="form-group">
                    <input type="text" class="form-control" name="label" placeholder="Masukkan pertanyaan teks">
                </div>
            `;
                    break;
                case 'email':
                    inputHTML = `
                <div class="form-group">
                    <input type="email" class="form-control" name="label" placeholder="Masukkan pertanyaan email">
                </div>
            `;
                    break;
                case 'date':
                    inputHTML = `
                <div class="form-group">
                    <input type="text" class="form-control" name="label" placeholder="Contoh: Kapan Anda lulus?">
                </div>
                <input type="hidden" name="tipe" value="date">
            `;
                    break;
                case 'number':
                    inputHTML = `
                <div class="form-group">
                    <input type="text" class="form-control" name="label" placeholder="Masukkan pertanyaan angka">
                </div>
            `;
                    break;
                case 'phone':
                    inputHTML = `
                <div class="form-group">
                    <input type="tel" class="form-control" name="label" placeholder="Masukkan nomor telepon">
                </div>
            `;
                    break;
                case 'dropdown':
                case 'checkbox':
                case 'radio':
                    inputHTML = `
        <div class="form-group">
            <input type="text" class="form-control" name="label" placeholder="Masukkan pertanyaan">
        </div>
    `;

                    $('#optionsContainer').show();
                    $('#optionItems').html(`
        <div class="option-item d-flex mb-2">
            <input type="text" class="form-control me-2" name="label_opsi[]" placeholder="Label Opsi 1">
            <input type="text" class="form-control me-2" name="value_opsi[]" placeholder="Value Opsi 1">
            <i class="fas fa-times remove-option text-danger mt-2" style="cursor:pointer;"></i>
        </div>
        <div class="option-item d-flex mb-2">
            <input type="text" class="form-control me-2" name="label_opsi[]" placeholder="Label Opsi 2">
            <input type="text" class="form-control me-2" name="value_opsi[]" placeholder="Value Opsi 2">
            <i class="fas fa-times remove-option text-danger mt-2" style="cursor:pointer;"></i>
        </div>
    `);


                    // Tambahkan hanya jika belum ada elemen 'addOtherOption'
                    if ($('#addOtherOption').length === 0) {
                        $('#addOption').after(`
        <div class="form-check mt-3">
            <input type="checkbox" class="form-check-input" id="addOtherOption">
            <label class="form-check-label" for="addOtherOption">Aktifkan opsi "Lainnya"</label>
        </div>
        <div id="otherOptionPreview" class="mt-2" style="display:none;">
            <input type="text" class="form-control" placeholder="Silakan isi jawaban lainnya (preview)" disabled>
        </div>
    `);
                    }


                    // Toggle input preview "Lainnya"
                    $('#addOtherOption').on('change', function() {
                        if ($(this).is(':checked')) {
                            $('#otherOptionPreview').show();
                        } else {
                            $('#otherOptionPreview').hide();
                        }
                    });

                    break;






                case 'grid':
                    inputHTML = `
        <div class="mb-3">
            <input type="text" class="form-control" name="label" placeholder="Contoh: Penilaian Kompetensi" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Baris (Kompetensi yang dinilai):</label>
            <div class="grid-rows mb-2">
                <div class="input-group mb-2">
                    <input type="text" class="form-control grid-row-input" placeholder="Contoh: Bekerja Tim" value="Bekerja Tim">
                    <button type="button" class="btn btn-outline-danger remove-row">×</button>
                </div>
                <div class="input-group mb-2">
                    <input type="text" class="form-control grid-row-input" placeholder="Contoh: Komunikasi" value="Komunikasi">
                    <button type="button" class="btn btn-outline-danger remove-row">×</button>
                </div>
                <div class="input-group mb-2">
                    <input type="text" class="form-control grid-row-input" placeholder="Contoh: Bahasa" value="Bahasa">
                    <button type="button" class="btn btn-outline-danger remove-row">×</button>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-outline-primary add-grid-row">
                <i class="fas fa-plus"></i> Tambah Kompetensi
            </button>
        </div>

        <div class="mb-3">
            <label class="form-label">Skala Penilaian:</label>
            <div class="row">
                <div class="col">
                    <input type="number" class="form-control scale-min" placeholder="Min (contoh: 1)" value="1" min="1" max="20">
                </div>
                <div class="col">
                    <input type="number" class="form-control scale-max" placeholder="Max (contoh: 5)" value="5" min="1" max="20">
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-outline-secondary generate-scale">Buat Skala</button>
                </div>
            </div>
            <div class="grid-cols mt-3 mb-2 d-flex flex-wrap gap-2"></div>
        </div>

        <div class="mb-3">
            <label class="form-label">Label Header Skala:</label>
            <input type="text" class="form-control" name="scale_header" value="Tidak Penting - Cukup Penting" placeholder="Contoh: Tidak Puas - Sangat Puas">
        </div>

        <input type="hidden" name="grid_cols" class="grid-cols-hidden" value='["1","2","3","4","5"]'>
    `;
                    break;

                case 'scale':
                    inputHTML = `
                <div class="form-group">
                    <input type="text" class="form-control" name="label" placeholder="Masukkan pertanyaan skala">
                </div>
            `;
                    $('#optionsContainer').show();

                    $('#optionItems').html(`
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Minimum Value</label>
                        <input type="number" class="form-control" name="min_scale" value="1" min="0">
                    </div>
                    <div class="col-md-6">
                        <label>Maximum Value</label>
                        <input type="number" class="form-control" name="max_scale" value="5" min="1">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label>Labels (comma separated)</label>
                        <input type="text" class="form-control" name="point_labels" 
                            placeholder="Sangat Buruk,Buruk,Netral,Baik,Sangat Baik"
                            value="Sangat Buruk,Buruk,Netral,Baik,Sangat Baik">
                        <small class="text-muted">Pisahkan setiap label dengan koma</small>
                    </div>
                </div>
                <div class="scale-preview mt-3">
                    <h6>Preview:</h6>
                    <div class="scale-container bg-light p-3">
                        <div class="scale-options d-flex justify-content-between" id="scale-preview-options">
                            <!-- Preview akan diisi oleh JavaScript -->
                        </div>
                    </div>
                </div>
            `);

                    // Set default value untuk preview
                    $('input[name="point_labels"]').val("Sangat Buruk,Buruk,Netral,Baik,Sangat Baik");

                    // Update preview ketika nilai berubah
                    $('input[name="min_scale"], input[name="max_scale"], input[name="point_labels"]').on('input', updateScalePreview);
                    updateScalePreview(); // Panggil pertama kali untuk menampilkan preview awal
                    break;

                default:
                    // Fallback ke text
                    inputHTML = '<input type="text" class="form-control" name="label" placeholder="Masukkan pertanyaan">';

            }

            // Inject ke form
            $('#dynamicInputContainer').html(inputHTML);

            // Handle required checkbox change
            $('#isRequired').off('change').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#required-star').show();
                } else {
                    $('#required-star').hide();
                }
            });
        });




        // Add option
        $('#addOption').click(function() {
            const optionCount = $('#optionItems .option-item').length + 1;
            $('#optionItems').append(`
        <div class="option-item d-flex mb-2">
            <input type="text" class="form-control me-2" name="label_opsi[]" placeholder="Label Opsi ${optionCount}">
            <input type="text" class="form-control me-2" name="value_opsi[]" placeholder="Value Opsi ${optionCount}">
            <i class="fas fa-times remove-option text-danger mt-2" style="cursor:pointer;"></i>
        </div>
    `);
        });


        // Remove option
        $(document).on('click', '.remove-option', function() {
            if ($('#optionItems .option-item').length > 1) {
                $(this).closest('.option-item').remove();
            } else {
                alert('Pertanyaan ini membutuhkan setidaknya satu opsi');
            }
        });

        // Save question
      $('#saveQuestion').click(function () {
    const saveBtn = $(this);
    saveBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');

    const questionLabel = $('#dynamicInputContainer input[name="label"]').val();
    if (!questionLabel && currentQuestionType !== 'user_field') {
        Swal.fire('Oops!', 'Judul pertanyaan harus diisi', 'warning');
        saveBtn.prop('disabled', false).html('<i class="fas fa-save"></i> Simpan Pertanyaan');
        return;
    }

    let errorMsg = '';
    if (currentQuestionType === 'grid') {
        const rowCount = $('.grid-row-input').filter(function () {
            return $(this).val().trim() !== '';
        }).length;

        if (rowCount < 1) {
            errorMsg = 'Grid harus memiliki minimal 1 kompetensi/baris';
        }

        const rowValues = [];
        $('.grid-row-input').each(function () {
            const val = $(this).val().trim();
            if (val) {
                if (rowValues.includes(val)) {
                    errorMsg = `Kompetensi "${val}" sudah ada. Harap masukkan kompetensi yang unik`;
                    return false;
                }
                rowValues.push(val);
            }
        });

        const scaleHeader = $('input[name="scale_header"]').val().trim();
        if (!scaleHeader) {
            errorMsg = 'Label header skala harus diisi';
        }

    } else if (currentQuestionType === 'scale') {
        const min = parseInt($('input[name="min_scale"]').val()) || 1;
        const max = parseInt($('input[name="max_scale"]').val()) || 5;

        if (min < 1) errorMsg = 'Nilai minimum tidak boleh kurang dari 1';
        if (max > 100) errorMsg = 'Nilai maksimum tidak boleh lebih dari 100';
        if (max <= min) errorMsg = 'Nilai maksimum harus lebih besar dari minimum';

        const labels = $('input[name="point_labels"]').val() || '';
        const labelCount = labels ? labels.split(',').length : 0;
        if (labels && labelCount !== (max - min + 1)) {
            errorMsg = 'Jumlah label harus sama dengan range nilai (max - min + 1)';
        }

    } else if (currentQuestionType === 'user_field') {
        const selectedField = $('#user_field').val();
        if (!selectedField) {
            errorMsg = 'Pilih field data pengguna yang akan digunakan';
        }
    }

    if (errorMsg) {
        Swal.fire('Oops!', errorMsg, 'warning');
        saveBtn.prop('disabled', false).html('<i class="fas fa-save"></i> Simpan Pertanyaan');
        return;
    }

    const formData = new FormData();
    formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
    formData.append('section_id', currentSectionId);
    formData.append('type', currentQuestionType);
    formData.append('label', questionLabel || 'Data Pengguna');
    formData.append('required', $('#isRequired').is(':checked') ? 1 : 0);
    formData.append('note', $('#questionNote').val() || '');

    if (currentQuestionType === 'grid') {
        const rows = [];
        $('.grid-row-input').each(function () {
            const val = $(this).val().trim();
            if (val) rows.push(val);
        });

        const cols = ["1", "2", "3", "4", "5"];
        const scaleHeader = $('input[name="scale_header"]').val().trim();

        formData.append('grid_rows', JSON.stringify(rows));
        formData.append('grid_cols', JSON.stringify(cols));
        formData.append('scale_header', scaleHeader);

    } else if (currentQuestionType === 'scale') {
        formData.append('min_scale', $('input[name="min_scale"]').val());
        formData.append('max_scale', $('input[name="max_scale"]').val());
        formData.append('point_labels', $('input[name="point_labels"]').val());

    } else if (['dropdown', 'checkbox', 'radio'].includes(currentQuestionType)) {
        const options = [];
        const labels = $('input[name="label_opsi[]"]');
        const values = $('input[name="value_opsi[]"]');

        for (let i = 0; i < labels.length; i++) {
            const label = $(labels[i]).val().trim();
            const value = $(values[i]).val().trim();
            if (label) {
                options.push({
                    label: label,
                    value: value !== '' ? value : label
                });
            }
        }

        if ($('#addOtherOption').is(':checked')) {
            options.push({ label: 'Lainnya', value: 'Lainnya' });
        }

        formData.append('options', JSON.stringify(options));

    } else if (currentQuestionType === 'user_field') {
        const selectedField = $('#user_field').val();
        formData.append('options', selectedField);
    }

    $.ajax({
        url: currentQuestionId
            ? `/Kuesioner/update_field/${currentQuestionId}`
            : '/Kuesioner/add_field',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.success) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Pertanyaan berhasil disimpan.',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
                loadSectionFields(currentSectionId);
                resetQuestionForm();
            } else {
                const errorMsg = response.message ||
                    (response.errors ? Object.values(response.errors).join('\n') : 'Gagal menyimpan pertanyaan');
                Swal.fire('Gagal!', errorMsg, 'error');
            }
        },
        error: function (xhr) {
            let errorMsg = 'Terjadi kesalahan saat menyimpan';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMsg = xhr.responseJSON.message;
            } else if (xhr.status === 422) {
                errorMsg = 'Validasi gagal: ' + JSON.stringify(xhr.responseJSON.errors);
            } else if (xhr.statusText) {
                errorMsg += ': ' + xhr.statusText;
            }
            Swal.fire('Error!', errorMsg, 'error');
        },
        complete: function () {
            saveBtn.prop('disabled', false).html('<i class="fas fa-save"></i> Simpan Pertanyaan');
        }
    });
});


        // Reset question form function
        function resetQuestionForm() {
            $('.question-type-option').removeClass('active');
            $('#questionForm').hide();
            $('#dynamicInputContainer').empty();
            $('#optionsContainer').hide();
            $('#optionItems').empty();
            $('#user-field-container').hide().find('select').val('');
            $('#isRequired').prop('checked', false);
            $('#questionNote').val('');
            currentQuestionType = null;
            currentQuestionId = null;
        }

        // Cancel question
        $('#cancelQuestion').click(function() {
            resetQuestionForm();
        });

        // Reset question form
        function resetQuestionForm() {
            $('.question-type-option').removeClass('active');
            $('#questionForm').hide();
            $('#questionText').val('');
            $('#optionsContainer').hide();
            $('#optionItems').html(`
                <div class="option-item">
                    <input type="text" class="form-control" name="opsi[]" placeholder="Opsi 1">
                    <i class="fas fa-times remove-option"></i>
                </div>
                <div class="option-item">
                    <input type="text" class="form-control" name="opsi[]" placeholder="Opsi 2">
                    <i class="fas fa-times remove-option"></i>
                </div>
            `);
            $('#isRequired').prop('checked', false);
            currentQuestionType = null;
            currentQuestionId = null;
        }

        //fungsi load pertanyaan di dalam section
        // Global variable to track loading state
        let isLoadingQuestions = false;

        function loadSectionFields(sectionId) {
            // Validate sectionId
            if (!sectionId || isLoadingQuestions) {
                console.log('Load prevented - invalid section or already loading');
                return;
            }

            // Set loading state
            isLoadingQuestions = true;
            const container = $('.questions-list');

            // Only show initial loading if container is empty
            if (container.children().length === 0) {
                container.html(`
            <div class="text-center py-2">
                <span class="spinner-border spinner-border-sm text-primary me-2"></span>
                <span>Memuat pertanyaan...</span>
            </div>
        `);
            }

            $.ajax({
                url: `<?= base_url('Kuesioner/get_section_questions/') ?>${sectionId}`,
                type: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function(response) {
                    // Reset loading state
                    isLoadingQuestions = false;

                    // Verify we're still viewing the same section
                    if (currentSectionId !== sectionId) {
                        console.log('Load cancelled - section changed');
                        return;
                    }

                    container.empty();

                    if (response.success && response.data && response.data.length > 0) {
                        response.data.forEach((field, index) => {
                            container.append(buildQuestionItem(field, index));
                        });
                    } else {
                        container.append(`
                    <div class="alert alert-info py-2">
                        <i class="fas fa-info-circle me-2"></i>
                        Belum ada pertanyaan
                    </div>
                `);
                    }
                },
                error: function(xhr, status, error) {
                    // Reset loading state
                    isLoadingQuestions = false;

                    console.error('Error loading questions:', error);
                    container.html(`
                <div class="alert alert-danger py-2">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Gagal memuat pertanyaan
                </div>
            `);
                }
            });
        }

        // Optimized question builder (unchanged from previous)
        function buildQuestionItem(field, index) {
            // Validate required fields
            if (!field || !field.type || !field.id) {
                console.error('Invalid field data:', field);
                return errorFallbackItem(index, 'Invalid question data');
            }

            // Safely parse options
            let options = [];
            try {
                options = typeof field.options === 'string' ?
                    JSON.parse(field.options) :
                    (field.options || []);

                // Handle case where options is an object (like scale)
                if (options && typeof options === 'object' && !Array.isArray(options)) {
                    options = [options]; // Convert to array
                }
            } catch (e) {
                console.error('Error parsing options:', e);
                options = [];
            }

            // Required indicator
            const isRequired = field.required === true || field.required === "true" || field.required === 1 || field.required === "1";
            const requiredStar = isRequired ? '<span class="text-danger"> *</span>' : '';

            // Build preview based on type
            let previewHtml = '';
            try {
                switch (field.type.toLowerCase()) { // Case insensitive
                    case 'text':
                    case 'email':
                    case 'number':
                    case 'phone':
                        previewHtml = buildTextPreview(field, requiredStar);
                        break;

                    case 'date':
                        previewHtml = buildDatePreview(field, requiredStar);
                        break;

                    case 'dropdown':
                        previewHtml = buildDropdownPreview(field, options, requiredStar);
                        break;

                    case 'checkbox':
                        previewHtml = buildCheckboxPreview(field, options, requiredStar);
                        break;

                    case 'radio':
                        previewHtml = buildRadioPreview(field, options, requiredStar);
                        break;

                    case 'scale':
                        previewHtml = buildScalePreview(field, options, requiredStar);
                        break;

                    case 'grid':
                        previewHtml = buildGridPreview(field);
                        break;
                    case 'user_field':
                        previewHtml = buildUserFieldPreview(field, requiredStar);
                        break;

                    default:
                        previewHtml = buildDefaultPreview(field);
                }
            } catch (e) {
                console.error(`Error building ${field.type} preview:`, e);
                previewHtml = errorPreview(field.type);
            }

            return buildQuestionContainer(field, index, previewHtml, requiredStar);
        }

        // Helper functions (unchanged from previous)
        function parseScaleOptions(field) {
            let min = 1,
                max = 5;
            let labels = [];

            if (field.options) {
                try {
                    const options = typeof field.options === 'string' ?
                        JSON.parse(field.options) :
                        field.options;

                    min = options.min || min;
                    max = options.max || max;
                    labels = options.labels || [];
                } catch (e) {
                    console.error('Error parsing scale options:', e);
                }
            }

            if (field.point_labels) {
                labels = field.point_labels.split(',').map(l => l.trim());
            }

            return {
                min,
                max,
                labels
            };
        }

        function buildScalePreview(scaleData, field) {
            const {
                min,
                max,
                labels
            } = scaleData;
            const count = max - min + 1;

            return `
        <div class="scale-options d-flex justify-content-between">
            ${Array.from({length: count}, (_, i) => {
                const value = min + i;
                const label = labels[i] || value;
                return ` <
                div class = "text-center" >
                <
                input type = "radio"
            name = "preview_${field.id}"
            id = "preview_${field.id}_${value}"
            value = "${value}"
            $ {
                field.required ? 'required' : ''
            }
            class = "form-check-input" >
            <
            label
            for = "preview_${field.id}_${value}"
            class = "d-block mt-1 small" >
            $ {
                label
            } <
            /label> < /
            div >
                `;
            }).join('')}
        </div>
    `;
        }

        function getTypeName(type) {
            const typeNames = {
                'text': 'Teks',
                'email': 'Email',
                'date': 'Tanggal',
                'number': 'Angka',
                'phone': 'Telepon',
                'dropdown': 'Dropdown',
                'checkbox': 'Checkbox',
                'radio': 'Radio Button',
                'scale': 'Skala',
                'grid': 'Grid',
                'user_field': 'Data Pengguna'
            };
            return typeNames[type.toLowerCase()] || type;
        }

        // Helper function to show error message
        function showErrorAlert(message) {
            $('.questions-list').html(`
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `);
        }

        // Helper function to show no questions message
        function showNoQuestionsMessage(container) {
            container.html(`
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            Belum ada pertanyaan dalam section ini
        </div>
    `);
        }

        function updateScalePreview() {
            const min = parseInt($('input[name="min_scale"]').val()) || 1;
            const max = parseInt($('input[name="max_scale"]').val()) || 5;

            // Validasi input
            if (min < 1) {
                alert('Nilai minimum tidak boleh kurang dari 1');
                $('input[name="min_scale"]').val(1);
                return;
            }

            if (max > 100) {
                alert('Nilai maksimum tidak boleh lebih dari 100');
                $('input[name="max_scale"]').val(100);
                return;
            }

            if (max <= min) {
                alert('Nilai maksimum harus lebih besar dari minimum');
                $('input[name="max_scale"]').val(min + 1);
                return;
            }

            const count = max - min + 1;
            const labelsInput = $('input[name="point_labels"]').val();
            let labels = [];

            if (labelsInput) {
                labels = labelsInput.split(',').map(label => label.trim());
            }

            let optionsHtml = '';
            for (let i = 0; i < count; i++) {
                const value = min + i;
                const label = labels[i] || value;

                optionsHtml += `
            <div class="form-check form-check-inline" style="margin-right: 15px;">
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <input class="form-check-input" type="radio" name="preview_scale" id="preview_scale_${value}" value="${value}">
                    <label class="form-check-label" for="preview_scale_${value}" style="margin-top: 5px; font-size: 0.8rem;">
                        ${label}
                    </label>
                </div>
            </div>
        `;
            }

            $('#scale-preview-options').html(optionsHtml);
        }

        // Panggil saat input berubah
        $('input[name="min_scale"], input[name="max_scale"], input[name="point_labels"]').on('input', updateScalePreview);

        // Inisialisasi preview awal
        updateScalePreview();

        // Edit question
        $(document).on('click', '.edit-question', function() {
            const fieldId = $(this).data('id');
            currentQuestionId = fieldId;

            // Load field data
            $.ajax({
                url: `<?= base_url('Kuesioner/get_field/') ?>${fieldId}`,
                type: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success && response.data) {
                        const field = response.data;

                        // Select the question type
                        const typeOption = $(`.question-type-option[data-type="${field.type}"]`);
                        if (typeOption.length) {
                            typeOption.click();
                        } else {
                            console.error('Question type not found:', field.type);
                            alert('Tipe pertanyaan tidak dikenali');
                            return;
                        }

                        // Set basic fields
                        $('#dynamicInputContainer input[name="label"]').val(field.label || '');
                        $('#isRequired').prop('checked', field.required == 1).trigger('change');
                        $('#questionNote').val(field.note || '');

                        // Parse options if they exist
                        let options = [];
                        if (field.options) {
                            try {
                                options = typeof field.options === 'string' ?
                                    JSON.parse(field.options) :
                                    field.options;
                            } catch (e) {
                                console.error('Error parsing options:', e);
                                options = [];
                            }
                        }

                        // Handle user_field type
                        if (field.type === 'user_field') {
                            $('#btnUserField').click(); // Trigger modal atau panel pemilihan user_field

                            // Pastikan options ada dan berbentuk array
                            if (Array.isArray(options) && options.length > 0) {
                                $('#user_field').val(options[0]).trigger('change');
                            } else if (typeof options === 'string') {
                                // Kalau ternyata options langsung berupa string tunggal
                                $('#user_field').val(options).trigger('change');
                            }
                        }


                        // Handle other types
                        else if (options.length > 0 || field.type === 'scale') {
                            $('#optionsContainer').show();
                            $('#optionItems').empty();

                            if (field.type === 'scale') {
                                const min = field.scale_min ?? 1;
                                const max = field.scale_max ?? 5;
                                const labels = Array.isArray(field.point_labels) ?
                                    field.point_labels.join(',') :
                                    (field.point_labels || '');

                                $('#optionItems').html(`
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Minimum Value</label>
                <input type="number" class="form-control" name="min_scale" value="${min}" min="0">
            </div>
            <div class="col-md-6">
                <label>Maximum Value</label>
                <input type="number" class="form-control" name="max_scale" value="${max}" min="1">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label>Labels (comma separated)</label>
                <input type="text" class="form-control" name="point_labels" 
                    placeholder="Sangat Buruk,Buruk,Netral,Baik,Sangat Baik"
                    value="${labels}">
                <small class="text-muted">Pisahkan setiap label dengan koma</small>
            </div>
        </div>
        <div class="scale-preview mt-3">
            <h6>Preview:</h6>
            <div class="scale-container bg-light p-3">
                <div class="scale-options d-flex justify-content-between" id="scale-preview-options">
                    <!-- Preview will be filled by JavaScript -->
                </div>
            </div>
        </div>
    `);

                                $('input[name="min_scale"], input[name="max_scale"], input[name="point_labels"]').on('input', updateScalePreview);
                                updateScalePreview();
                            } else {
                                options.forEach((option, index) => {
                                    let label = typeof option === 'object' ? option.label || '' : option;
                                    let value = typeof option === 'object' ? option.value || '' : option;

                                    $('#optionItems').append(`
        <div class="option-item mb-2">
            <div class="row">
                <div class="col-md-6 mb-1">
                    <input type="text" class="form-control" name="label_opsi[]" value="${label}" placeholder="Label Opsi ${index + 1}">
                </div>
                <div class="col-md-5 mb-1">
                    <input type="text" class="form-control" name="value_opsi[]" value="${value}" placeholder="Value Opsi ${index + 1}">
                </div>
                <div class="col-md-1 d-flex align-items-center">
                    <i class="fas fa-times remove-option text-danger cursor-pointer"></i>
                </div>
            </div>
        </div>
    `);
                                });
                            }
                        } else {
                            $('#optionsContainer').hide();
                        }

                        $('html, body').animate({
                            scrollTop: $('#questionForm').offset().top - 100
                        }, 500);
                    } else {
                        console.error('Response error:', response);
                        alert(response.message || 'Gagal memuat data pertanyaan');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error, xhr.responseText);
                    if (xhr.status === 419) {
                        alert('Session expired. Silakan refresh halaman dan coba lagi.');
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan saat memuat pertanyaan: ' + error);
                    }
                }
            });
        });

        // Helper functions for different question types
        function buildTextPreview(field, requiredStar) {
            const inputType = field.type === 'number' ? 'number' :
                field.type === 'email' ? 'email' :
                field.type === 'phone' ? 'tel' : 'text';

            return `
    <div class="mb-2">
        <input type="${inputType}" class="form-control form-control-sm"
               placeholder="${field.placeholder || ''}"
               ${field.required ? 'required' : ''}>
    </div>
`;
        }

        function buildGridPreview(field) {
            const rows = field.grid_rows || field.options?.rows || ['Contoh Baris'];
            const cols = field.grid_cols || field.options?.columns || ['1', '2', '3', '4', '5'];

            return `
        <div class="table-responsive">
            <table class="table table-bordered grid-table">
                <thead>
                    <tr>
                        <th colspan="${cols.length}" class="text-center">Skala Penilaian</th>
                    </tr>
                    <tr>
                        <th></th>
                        ${cols.map(col => `
                            <th class="text-center scale-header">
                                <div class="scale-label">${getRatingLabel(col)}</div>
                                <div class="scale-number">${col}</div>
                            </th>
                        `).join('')}
                    </tr>
                </thead>
                <tbody>
                    ${rows.map((row, rowIndex) => `
                        <tr>
                            <td class="question-label">${row}</td>
                            ${cols.map((col, colIndex) => `
                                <td class="text-center">
                                    <input type="radio" 
                                           name="grid_${field.id}_${rowIndex}" 
                                           value="${col}"
                                           ${field.required ? 'required' : ''}
                                           class="form-check-input">
                                </td>
                            `).join('')}
                        </tr>
                    `).join('')}
                </tbody>
            </table>
        </div>
    `;
        }



        function buildDropdownPreview(field, options, requiredStar) {
            const hasOther = options.some(opt => opt.value.toLowerCase() === 'lainnya');
            return `
        <div class="mb-2">
            <select class="form-select form-select-sm" ${field.required ? 'required' : ''} onchange="handleOtherInput(this, '${field.id}')">
                <option value="">Pilih salah satu</option>
                ${options.map(opt => `
                    <option value="${escapeHtml(opt.value)}">${escapeHtml(opt.label)}</option>
                `).join('')}
            </select>
            ${hasOther ? `<input type="text" class="form-control mt-2" id="other_input_${field.id}" placeholder="Silakan isi jawaban Anda" style="display:none;">` : ''}
        </div>
    `;
        }

        function buildCheckboxPreview(field, options, requiredStar) {
            const hasOther = options.some(opt => opt.value.toLowerCase() === 'lainnya');
            return `
        <div class="mb-2">
            ${options.map((opt, i) => `
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="checkbox_${field.id}_${i}" value="${escapeHtml(opt.value)}"
                        onchange="handleCheckboxOther('${field.id}', '${escapeHtml(opt.value)}')">
                    <label class="form-check-label" for="checkbox_${field.id}_${i}">
                        ${escapeHtml(opt.label)}
                    </label>
                </div>
            `).join('')}
            ${hasOther ? `<input type="text" class="form-control mt-2" id="other_input_${field.id}" placeholder="Silakan isi jawaban Anda" style="display:none;">` : ''}
        </div>
    `;
        }

        function buildRadioPreview(field, options, requiredStar) {
            const hasOther = options.some(opt => opt.value.toLowerCase() === 'lainnya');
            return `
        <div class="mb-2">
            ${options.map((opt, i) => `
                <div class="form-check">
                    <input class="form-check-input" type="radio"
                        name="preview_${field.id}"
                        id="radio_${field.id}_${i}"
                        value="${escapeHtml(opt.value)}"
                        ${field.required ? 'required' : ''}
                        onchange="handleOtherInput(this, '${field.id}')">
                    <label class="form-check-label" for="radio_${field.id}_${i}">
                        ${escapeHtml(opt.label)}
                    </label>
                </div>
            `).join('')}
            ${hasOther ? `<input type="text" class="form-control mt-2" id="other_input_${field.id}" placeholder="Silakan isi jawaban Anda" style="display:none;">` : ''}
        </div>
    `;
        }


         function buildScalePreview(field, options = {}, requiredStar = '') {
    // Ambil nilai min & max dengan fallback aman
    const min = field.min_scale ?? field.options?.min ?? options.min ?? 1;
    const max = field.max_scale ?? field.options?.max ?? options.max ?? 5;

    // Ambil label skala (opsional)
    const labels = field.point_labels ?? field.options?.point_labels ?? options.point_labels ?? options.labels ?? [];

    return `
        <div class="scale-options d-flex justify-content-between mt-2">
            ${Array.from({ length: max - min + 1 }, (_, i) => {
                const value = min + i;
                const label = labels[i] !== undefined ? labels[i] : value;

                return `
                    <div class="text-center">
                        <input type="radio"
                            name="preview_${field.id}"
                            value="${value}"
                            class="form-check-input"
                            ${field.required ? 'required' : ''}>
                        <label class="d-block small mt-1">${escapeHtml(label)}</label>
                    </div>
                `;
            }).join('')}
        </div>
    `;
}

        function escapeHtml(unsafe) {
            if (!unsafe) return '';
            return unsafe.toString()
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        function errorPreview(type) {
            const typeName = getTypeName(type);
            return `
        <div class="alert alert-warning py-2">
            <i class="fas fa-exclamation-triangle me-2"></i>
            Gagal menampilkan pratinjau ${typeName}
            <button class="btn btn-sm btn-outline-secondary mt-1" 
                    onclick="this.closest('.question-item').querySelector('.edit-question').click()">
                <i class="fas fa-edit me-1"></i> Edit Pertanyaan
            </button>
        </div>
    `;
        }

        function buildQuestionContainer(field, index, previewHtml, requiredStar) {
            return `
        <div class="question-item mb-3 p-3 border rounded" data-id="${field.id}">
            <!-- Header with question number and actions -->
            <div class="d-flex justify-content-between align-items-start">
                <div class="flex-grow-1">
                    <div class="d-flex align-items-center">
                        <span class="badge bg-light text-dark me-2">${index + 1}</span>
                        <h6 class="mb-0">${escapeHtml(field.label || 'Untitled Question')}${requiredStar}</h6>
                    </div>
                    <div class="d-flex mt-1">
                        <span class="badge bg-secondary me-1">${getTypeName(field.type)}</span>
                        ${field.required ? '<span class="badge bg-warning text-dark">Required</span>' : ''}
                    </div>
                </div>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary edit-question" data-id="${field.id}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-outline-danger delete-question" data-id="${field.id}">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            
            <!-- Question preview -->
            <div class="question-preview mt-2">
                ${field.note ? `<small class="text-muted d-block mb-2">${escapeHtml(field.note)}</small>` : ''}
                ${previewHtml}
            </div>
        </div>
    `;
        }


        function buildDatePreview(field, requiredStar) {
            return `
        <div class="mb-2">
            <input type="date" class="form-control form-control-sm"
                   ${field.required ? 'required' : ''}>
            ${field.placeholder ? `<small class="text-muted">${escapeHtml(field.placeholder)}</small>` : ''}
        </div>
    `;
        }


        function escapeHtml(unsafe) {
            if (!unsafe) return '';
            return unsafe.toString()
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        function getTypeName(type) {
            const typeNames = {
                'text': 'Teks',
                'email': 'Email',
                'date': 'Tanggal',
                'number': 'Angka',
                'phone': 'Telepon',
                'dropdown': 'Dropdown',
                'checkbox': 'Checkbox',
                'radio': 'Radio Button',
                'scale': 'Skala',
                'grid': 'Grid',
                'user_field': 'Data Pengguna'
            };
            return typeNames[type.toLowerCase()] || type;
        }

        function buildUserFieldPreview(field, requiredStar) {
            // Get the selected user field
            const userField = field.options && field.options.length > 0 ? field.options[0] : 'User Data';

            // Determine input type based on field type
            let inputType = 'text';
            let placeholder = '';

            // Customize input based on field type
            switch (userField.toLowerCase()) {
                case 'email':
                    inputType = 'email';
                    placeholder = 'user@example.com';
                    break;
                case 'no_hp':
                case 'phone':
                    inputType = 'tel';
                    placeholder = '08123456789';
                    break;
                case 'angkatan':
                case 'tahun_kelulusan':
                    inputType = 'number';
                    placeholder = '2015';
                    break;
                case 'jenis_kelamin':
                    // For gender, we'll use select
                    return buildGenderSelectPreview(field, requiredStar);
                case 'jurusan':
                case 'program_studi':
                    // For major/study program, we'll use select
                    return buildMajorSelectPreview(field, requiredStar);
                default:
                    inputType = 'text';
            }

            return `
        <div class="mb-2">
            <label class="form-label">${field.label || 'Data Pengguna'}${requiredStar}</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-user"></i>
                </span>
                <input type="${inputType}" class="form-control form-control-sm"
                       placeholder="${placeholder}"
                       value="[${userField}]"
                       readonly
                       ${field.required ? 'required' : ''}>
            </div>
            <small class="text-muted">Data akan diisi otomatis dari profil pengguna</small>
        </div>
    `;
        }

        // Helper function for gender select
        function buildGenderSelectPreview(field, requiredStar) {
            return `
        <div class="mb-2">
            <label class="form-label">${field.label || 'Jenis Kelamin'}${requiredStar}</label>
            <select class="form-select form-select-sm" ${field.required ? 'required' : ''}>
                <option value="">Pilih jenis kelamin</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
            <small class="text-muted">Data akan diisi otomatis dari profil pengguna</small>
        </div>
    `;
        }

        // Helper function for major/study program select
        function buildMajorSelectPreview(field, requiredStar) {
            return `
        <div class="mb-2">
            <label class="form-label">${field.label || 'Program Studi'}${requiredStar}</label>
            <select class="form-select form-select-sm" ${field.required ? 'required' : ''}>
                <option value="">Pilih program studi</option>
                <option value="Teknik Informatika">Teknik Informatika</option>
                <option value="Sistem Informasi">Sistem Informasi</option>
                <option value="Teknik Komputer">Teknik Komputer</option>
            </select>
            <small class="text-muted">Data akan diisi otomatis dari profil pengguna</small>
        </div>
    `;
        }

        function getRatingLabel(value) {
            const labels = {
                '1': 'Sangat Kurang',
                '2': 'Kurang',
                '3': 'Cukup',
                '4': 'Baik',
                '5': 'Sangat Baik'
            };
            return labels[value] || value;
        }

        function getTypeName(type) {
            const types = {
                'text': 'Teks',
                'email': 'Email',
                'date': 'Tanggal',
                'number': 'Angka',
                'phone': 'Telepon',
                'dropdown': 'Dropdown',
                'checkbox': 'Checkbox',
                'radio': 'Radio',
                'scale': 'Skala',
                'grid': 'Grid'
            };
            return types[type] || type;
        }


        // Delete question with SweetAlert2
        $(document).on('click', '.delete-question', function() {
            const fieldId = $(this).data('id');

            Swal.fire({
                title: 'Yakin ingin menghapus pertanyaan ini?',
                text: "Pertanyaan ini akan dihapus secara permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `<?= base_url('Kuesioner/delete_field/') ?>${fieldId}`,
                        type: 'DELETE',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Terhapus!',
                                    text: 'Pertanyaan berhasil dihapus.',
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                                loadSectionFields(currentSectionId);
                            } else {
                                Swal.fire('Gagal!', response.message || 'Gagal menghapus pertanyaan.', 'error');
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr);
                            if (xhr.status === 419) {
                                Swal.fire('Sesi Habis!', 'Session expired. Silakan refresh halaman dan coba lagi.', 'warning').then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error!', 'Terjadi kesalahan saat menghapus pertanyaan.', 'error');
                            }
                        }
                    });
                }
            });
        });

        // Save questionnaire changes with SweetAlert2
        $('#simpan-perubahan').click(function(e) {
            e.preventDefault();

            // Validate form
            if (!$('#edit-title').val() || !$('#edit-deskripsi').val()) {
                Swal.fire('Oops!', 'Judul dan Deskripsi harus diisi.', 'warning');
                return;
            }

            // Collect form data
            const formData = {
                id: $('#edit-id').val(),
                title: $('#edit-title').val(),
                deskripsi: $('#edit-deskripsi').val(),
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            };

            if ($('#enable-conditional-logic').is(':checked')) {
                const logicRules = [];

                $('.logic-row').each(function() {
                    const row = $(this);
                    const field = row.find('select.user-field-select').val();
                    const condition = row.find('select.logic-operator').val();

                    let value = row.find('input[name="value"]').val();
                    if (!value) {
                        value = row.find('select[name="value"]').val();
                    }

                    if (field && condition && value) {
                        logicRules.push({
                            ShowIf: field,
                            condition: condition,
                            value: value
                        });
                    }
                });

                formData.conditional_logic = JSON.stringify(logicRules);
            }

            // Kirim lewat AJAX
            $.ajax({
                url: '<?= base_url('Kuesioner/update') ?>',
                type: 'POST',
                data: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Kuesioner berhasil diperbarui.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = '<?= base_url('Kuesioner') ?>';
                        });
                    } else {
                        Swal.fire('Gagal!', response.message || 'Gagal memperbarui kuesioner.', 'error');
                        if (response.errors) {
                            console.error('Validation errors:', response.errors);
                        }
                    }
                },
                error: function(xhr) {
                    console.error(xhr);
                    let errorMsg = 'Terjadi kesalahan saat memperbarui kuesioner';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    Swal.fire('Error!', errorMsg, 'error');
                }
            });
        });


        // Delete questionnaire with SweetAlert2
        $(document).on('click', '.btn-delete', function() {
            const id = $(this).data('id');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data kuesioner akan dihapus secara permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `<?= base_url('Kuesioner/delete/') ?>${id}`,
                        type: 'DELETE',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                $(`#kuesioner-${id}`).remove();
                                Swal.fire('Berhasil!', 'Kuesioner berhasil dihapus.', 'success');
                            } else {
                                Swal.fire('Gagal!', response.message || 'Gagal menghapus kuesioner', 'error');
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr);
                            let errorMsg = 'Terjadi kesalahan saat menghapus kuesioner';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMsg = xhr.responseJSON.message;
                            }
                            Swal.fire('Error!', errorMsg, 'error');
                        }
                    });
                }
            });
        });

        $(document).on('click', '.btn-clone', function() {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Konfirmasi Clone',
                text: 'Apakah Anda yakin ingin meng-clone kuesioner ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Clone',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `<?= base_url('Kuesioner/clone/') ?>${id}`,
                        type: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                showAlert('success', 'Kuesioner berhasil di-clone');
                                location.reload();
                            } else {
                                showAlert('error', response.message || 'Gagal meng-clone kuesioner');
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr);
                            let errorMsg = 'Terjadi kesalahan saat meng-clone kuesioner';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMsg = xhr.responseJSON.message;
                            }
                            showAlert('error', errorMsg);
                        }
                    });
                }
            });
        });
        $(document).on('click', '.toggle-status', function() {
    const btn = $(this);
    const id = btn.data('id');

    $.ajax({
        url: `<?= base_url('Kuesioner/toggle_status/') ?>${id}`,
        type: 'POST',
        dataType: 'json',
        success: function(res) {
            if (res.success) {
                const newStatus = res.status;
                const isActive = newStatus === 'Ya';

                btn
                    .removeClass('btn-success btn-danger')
                    .addClass(isActive ? 'btn-danger' : 'btn-success')
                    .text(isActive ? 'Deactivate' : 'Activate')
                    .attr('data-active', newStatus);

                // ✅ Perbaikan selector kolom 'Aktif'
                btn.closest('tr').find('td').eq(4).text(isActive ? 'Ya' : '-');
            }
        }
    });
});


        // Initialize the first time
        function initialize() {
            // If there's an active menu in navigation, set as active
            $('.navigation li a.active').removeClass('active');
            const path = window.location.pathname;
            $('.navigation li a').each(function() {
                if ($(this).attr('href') === path) {
                    $(this).addClass('active');
                }
            });
        }

        // Call initialize when first loaded
        initialize();

        // skrip untuk dropdown data pengguna
        $(document).ready(function() {
            $('#btnUserField').click(function() {
                // Ubah pilihan jenis pertanyaan ke user_field
                $('.question-type-option').removeClass('selected');
                $(this).addClass('selected');

                // Tampilkan dropdown user_field DI BAWAH input pertanyaan
                $('#user-field-container').slideDown();

                // Load data field dari server
                $.ajax({
                    url: '<?= base_url("Kuesioner/user-fields") ?>',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            const dropdown = $('#user_field');
                            dropdown.empty();
                            dropdown.append('<option value="">-- Pilih Field --</option>');

                            response.data.forEach(function(field) {
                                dropdown.append(`<option value="${field}">${field}</option>`);
                            });
                        } else {
                            alert('Gagal memuat field pengguna');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        alert('Terjadi kesalahan saat mengambil data');
                    }
                });
            });


            // Sembunyikan dropdown jika tipe lain diklik
            $('.question-type-option').not('#btnUserField').click(function() {
                $('#user-field-container').slideUp();
            });
        });

        $(document).on('click', '.add-grid-row', function() {
            const rowInput = `
        <div class="input-group mb-2">
            <input type="text" class="form-control grid-row-input" placeholder="Label baris">
            <button type="button" class="btn btn-outline-danger remove-row">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
            $(this).siblings('.grid-rows').append(rowInput);
        });

        $(document).on('click', '.add-grid-col', function() {
            const colInput = `
        <div class="input-group mb-2">
            <input type="text" class="form-control grid-col-input" placeholder="Label kolom">
            <button type="button" class="btn btn-outline-danger remove-col">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
            $(this).siblings('.grid-cols').append(colInput);
        });

        // Untuk submit form
        $(document).on('submit', '#questionForm', function(e) {
            // Kumpulkan data grid
            const rows = [];
            $('.grid-row-input').each(function() {
                if ($(this).val().trim() !== '') {
                    rows.push($(this).val().trim());
                }
            });

            const cols = [];
            $('.grid-col-input').each(function() {
                if ($(this).val().trim() !== '') {
                    cols.push($(this).val().trim());
                }
            });

            // Tambahkan ke form data
            $('<input>').attr({
                type: 'hidden',
                name: 'grid_rows',
                value: JSON.stringify(rows)
            }).appendTo(this);

            $('<input>').attr({
                type: 'hidden',
                name: 'grid_cols',
                value: JSON.stringify(cols)
            }).appendTo(this);
        });

        // untuk skala penilaian grid
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('generate-scale')) {
                const container = e.target.closest('.mb-3');
                const min = parseInt(container.querySelector('.scale-min').value) || 1;
                const max = parseInt(container.querySelector('.scale-max').value) || 5;
                const colContainer = container.querySelector('.grid-cols');
                const hiddenInput = container.querySelector('.grid-cols-hidden');

                if (min > max || min < 1 || max > 20) {
                    alert("Skala minimum tidak boleh lebih dari maksimum dan maksimum tidak boleh lebih dari 20.");
                    return;
                }

                let cols = [];
                colContainer.innerHTML = '';
                for (let i = min; i <= max; i++) {
                    cols.push(i.toString());
                    const badge = document.createElement('span');
                    badge.className = 'badge bg-primary';
                    badge.textContent = i;
                    colContainer.appendChild(badge);
                }

                hiddenInput.value = JSON.stringify(cols);
            }
        });

        /// Script JavaScript Dinamis untuk value Conditional Logic
        document.addEventListener('DOMContentLoaded', function() {
            const logicRow = document.querySelector('.logic-row');
            const fieldSelect = logicRow.querySelector('.user-field-select');
            const valueContainer = logicRow.querySelector('.value-container');

            function createSelectElement() {
                const select = document.createElement('select');
                select.className = 'form-select form-select-sm logic-value-select';
                select.disabled = true;
                select.innerHTML = '<option value="">Pilih nilai</option>';
                return select;
            }

            function createInputElement() {
                const input = document.createElement('input');
                input.type = 'text';
                input.className = 'form-control form-control-sm logic-value-input';
                input.placeholder = 'Isi nilai';
                return input;
            }

            function replaceValueInput(newElement) {
                valueContainer.innerHTML = ''; // kosongkan
                valueContainer.appendChild(newElement);
            }

            fieldSelect.addEventListener('change', function() {
                const selectedField = this.value;

                if (selectedField === 'jurusan' || selectedField === 'program_studi') {
                    const select = createSelectElement();
                    replaceValueInput(select);

                    fetch(`/get-options/${selectedField}`)
                        .then(res => res.json())
                        .then(data => {
                            let options = '<option value="">-- Pilih --</option>';
                            data.forEach(item => {
                                options += `<option value="${item.id}">${item.name}</option>`;
                            });
                            select.innerHTML = options;
                            select.disabled = false;
                        })
                        .catch(() => {
                            select.innerHTML = '<option value="">Gagal memuat data</option>';
                            select.disabled = true;
                        });

                } else {
                    const input = createInputElement();
                    replaceValueInput(input);
                }
            });

            // Toggle tampilkan/hidden conditional logic
            document.getElementById('enable-conditional-logic').addEventListener('change', function() {
                document.getElementById('kuesioner-logic-container').style.display = this.checked ? 'block' : 'none';
            });
        });

    });
</script>
</body>

</html>