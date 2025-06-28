<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jurusan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Tambah Jurusan</h2>

        <!-- Tampilkan pesan error jika ada -->
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Form Tambah Jurusan -->
        <form action="<?= base_url('/jurusan/store') ?>" method="post">
            <?= csrf_field() ?> <!-- CSRF Protection -->

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Jurusan</label>
                <input type="text" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>"
                    id="nama" name="nama" value="<?= old('nama') ?>" required
                    placeholder="Masukkan nama jurusan">
                <div class="invalid-feedback">
                    <?= session('errors.nama') ?>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('/jurusan') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>