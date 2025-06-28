<!DOCTYPE html>
<html lang="id">

<head>
    <title>Edit Satuan Organisasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Satuan Organisasi</h2>
        
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <p><?= esc($error) ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>

        <form action="<?= base_url('/organisasi/update/' . $organization['id']) ?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Satuan Organisasi*</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= esc($organization['name']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="short_name" class="form-label">Singkatan</label>
                <input type="text" class="form-control" id="short_name" name="short_name" value="<?= esc($organization['short_name'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" value="<?= esc($organization['slug'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= esc($organization['description'] ?? '') ?></textarea>
            </div>

            <div class="mb-3">
    <label for="tipe" class="form-label">Tipe Organisasi*</label>
    <select class="form-select" id="tipe" name="tipe" required>
        <option value="">-- Pilih Tipe --</option>
        <?php foreach ($organizationTypes as $type): ?>
            <option value="<?= esc($type['name']) ?>" <?= $organization['tipe'] === $type['name'] ? 'selected' : '' ?>>
                <?= esc($type['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

            <div class="mb-3">
                <label for="urutan" class="form-label">Urutan</label>
                <input type="number" class="form-control" id="urutan" name="urutan" value="<?= esc($organization['urutan'] ?? '') ?>">
            </div>

            <div class="mb-3" id="parent_id_wrapper" style="<?= $organization['tipe'] === 'Program Studi' ? '' : 'display: none;' ?>">
                <label for="parent_id" class="form-label">Induk Organisasi (Jurusan)*</label>
                <select class="form-select" id="parent_id" name="parent_id" <?= $organization['tipe'] === 'Program Studi' ? 'required' : '' ?>>
                    <option value="">-- Pilih Jurusan --</option>
                    <?php foreach ($organizations as $org): ?>
                        <option value="<?= $org['id'] ?>" <?= $organization['parent_id'] == $org['id'] ? 'selected' : '' ?>>
                            <?= esc($org['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= base_url('/organisasi/units') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script>
        const typeSelect = document.getElementById('tipe');
        const parentWrapper = document.getElementById('parent_id_wrapper');
        const parentSelect = document.getElementById('parent_id');

        typeSelect.addEventListener('change', function() {
            if (this.value === 'Program Studi') {
                parentWrapper.style.display = 'block';
                parentSelect.required = true;
            } else {
                parentWrapper.style.display = 'none';
                parentSelect.required = false;
                parentSelect.value = '';
            }
        });
    </script>
</body>

</html>