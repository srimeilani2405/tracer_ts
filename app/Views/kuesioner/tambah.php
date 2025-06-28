<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kuesioner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-4">Tambah Kuesioner</h2>

        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/Kuesioner/simpan') ?>" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Judul Kuesioner</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= old('title') ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?= old('deskripsi') ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('/Kuesioner') ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>
