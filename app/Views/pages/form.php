<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h1><?= $title ?></h1>

    <form action="<?= $action ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label>Section</label>
            <input type="text" name="section" class="form-control" value="<?= old('section', $page['section'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" value="<?= old('title', $page['title'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label>Isi</label>
            <textarea name="content" class="form-control" rows="5" required><?= old('content', $page['content'] ?? '') ?></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= base_url('pages') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= $this->endSection() ?>
