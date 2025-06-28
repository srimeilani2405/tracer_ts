<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h2>Edit Kuesioner</h2>
    <form action="<?= base_url('/Kuesioner/update/' . $kuesioner['id']) ?>" method="post">
        <div class="form-group">
            <label for="title">Judul Kuesioner</label>
            <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($kuesioner['title']) ?>" required>
        </div>
        <div class="form-group">
            <label for="rules">Aturan Kuesioner</label>
            <textarea name="rules" id="rules" class="form-control" required><?= htmlspecialchars($kuesioner['rules']) ?></textarea>
        </div>
        <div class="form-group">
            <label for="active">Status Aktif</label>
            <select name="active" id="active" class="form-control" required>
                <option value="Ya" <?= $kuesioner['active'] === 'Ya' ? 'selected' : '' ?>>Ya</option>
                <option value="Tidak" <?= $kuesioner['active'] === 'Tidak' ? 'selected' : '' ?>>Tidak</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
<?= $this->endSection(); ?>