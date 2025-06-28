<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Halaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1>Edit Halaman</h1>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('pages/update/' . $page['id']) ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="title" class="form-label">Judul Halaman</label>
            <input type="text" name="title" id="title" class="form-control" value="<?= esc($page['title']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Isi Halaman</label>
            <textarea name="content" id="content" class="form-control" rows="6" required><?= esc($page['content']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= site_url('pages') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
