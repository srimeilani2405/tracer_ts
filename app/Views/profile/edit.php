<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="card p-4 shadow-sm">
            <h4 class="mb-4">Edit Pengguna "<?= esc($user['username']) ?>"</h4>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('/profile/update') ?>" method="post">
                <?= csrf_field() ?>

                <h5 class="mt-3">Account</h5>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail *</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= esc($user['email']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username *</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= esc($user['username']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Grup</label>
                    <select class="form-select" name="role" id="role">
                        <option value="Site Admin" <?= $user['role'] == 'Site Admin' ? 'selected' : '' ?>>Site Admin</option>
                        <option value="Admin" <?= $user['role'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="User" <?= $user['role'] == 'User' ? 'selected' : '' ?>>User</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Aktifkan</label>
                    <select class="form-select" name="status" id="status">
                        <option value="aktif" <?= $user['status'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                        <option value="nonaktif" <?= $user['status'] == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                </div>

                <h5 class="mt-4">Detail Pengguna</h5>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama *</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= esc($user['nama']) ?>" required>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-primary">Simpan & Tutup</button>
                    <a href="<?= base_url('/profile') ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
