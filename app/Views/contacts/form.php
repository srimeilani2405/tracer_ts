<form action="<?= site_url('contacts/store') ?>" method="post">
    <?= csrf_field() ?>

    <label>Nama:</label>
    <input type="text" name="name" value="<?= old('name') ?>" required>

    <label>Email:</label>
    <input type="email" name="email" value="<?= old('email') ?>" required>

    <label>Phone:</label>
    <input type="text" name="phone" value="<?= old('phone') ?>" required>

    <label>Jabatan:</label>
    <input type="text" name="position" value="<?= old('position') ?>">

    <label>Kualifikasi:</label>
    <input type="text" name="qualification" value="<?= old('qualification') ?>">

    <label>Jenis Kontak:</label>
    <select name="contact_type" required>
        <option value="">-- Pilih Tipe --</option>
        <?php foreach ($contactTypes as $key => $label): ?>
            <option value="<?= esc($key) ?>" <?= old('contact_type') === $key ? 'selected' : '' ?>>
                <?= esc($label) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Sort Order:</label>
    <input type="number" name="sort_order" value="<?= old('sort_order', 0) ?>">

    <button type="submit">Simpan</button>
</form>