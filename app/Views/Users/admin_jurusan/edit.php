<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin Jurusan - Tracer Study Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }

        .form-section h5 {
            margin-bottom: 1.5rem;
            color: #0d6efd;
        }

        .required-field::after {
            content: " *";
            color: red;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875em;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <h2 class="mb-4">Edit Admin Jurusan</h2>

        <!-- Tampilkan error validasi -->
        <?php if (session()->has('errors')): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger">
                <?= esc(session('error')) ?>
            </div>
        <?php endif ?>

        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('/admin_jurusan/update/' . $adminJurusan['id']) ?>" method="post">
                    <?= csrf_field() ?>

                    <!-- Bagian Akun -->
                    <div class="form-section">
                        <h5>Informasi Akun</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label required-field">E-mail</label>
                                <input type="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>"
                                    id="email" name="email" value="<?= esc($adminJurusan['email']) ?>" required>
                                <?php if (session('errors.email')): ?>
                                    <div class="error-message"><?= session('errors.email') ?></div>
                                <?php endif ?>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label required-field">Username</label>
                                <input type="text" class="form-control <?= session('errors.username') ? 'is-invalid' : '' ?>"
                                    id="username" name="username" value="<?= esc($adminJurusan['username']) ?>" required>
                                <?php if (session('errors.username')): ?>
                                    <div class="error-message"><?= session('errors.username') ?></div>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="group" class="form-label required-field">Grup Pengguna</label>
                                <select class="form-control <?= session('errors.group') ? 'is-invalid' : '' ?>"
                                    id="group" name="group" required disabled>
                                    <option value="admin_jurusan" selected>Admin Jurusan</option>
                                </select>
                                <?php if (session('errors.group')): ?>
                                    <div class="error-message"><?= session('errors.group') ?></div>
                                <?php endif ?>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="0" <?= $adminJurusan['status'] == '0' ? 'selected' : '' ?>>Tidak Aktif</option>
                                    <option value="1" <?= $adminJurusan['status'] == '1' ? 'selected' : '' ?>>Aktif</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>"
                                    id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                                <?php if (session('errors.password')): ?>
                                    <div class="error-message"><?= session('errors.password') ?></div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian Detail Pengguna -->
                    <div class="form-section">
                        <h5>Detail Pengguna</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label required-field">Nama Lengkap</label>
                                <input type="text" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>"
                                    id="nama" name="nama" value="<?= esc($adminJurusan['nama']) ?>" required>
                                <?php if (session('errors.nama')): ?>
                                    <div class="error-message"><?= session('errors.nama') ?></div>
                                <?php endif ?>
                            </div>
                        </div>

                        <!-- Khusus Admin Jurusan -->
                        <div id="departmentFields">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="jurusan" class="form-label required-field">Jurusan</label>
                                    <select class="form-control <?= session('errors.jurusan') ? 'is-invalid' : '' ?>" id="jurusan" name="jurusan" required>
                                        <option value="">-- Pilih Jurusan --</option>
                                        <?php foreach ($organizations as $org) : ?>
                                            <?php if ($org['parent_id'] == NULL) : ?>
                                                <option value="<?= $org['name'] ?>" <?= ($org['name'] == $adminJurusan['jurusan']) ? 'selected' : '' ?>>
                                                    <?= $org['name'] ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (session('errors.jurusan')): ?>
                                        <div class="error-message"><?= session('errors.jurusan') ?></div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= base_url('/admin_jurusan') ?>" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>