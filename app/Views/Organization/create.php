<!DOCTYPE html>
<html lang="id">

<head>
    <title>Tambah Satuan Organisasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Tambah Satuan Organisasi</h2>
        
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <p><?= esc($error) ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>

        <form action="<?= base_url('/organisasi/store') ?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Satuan Organisasi*</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="short_name" class="form-label">Singkatan</label>
                <input type="text" class="form-control" id="short_name" name="short_name">
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>

            <div class="mb-3">
    <label for="tipe" class="form-label">Tipe Organisasi*</label>
    <select class="form-select" id="tipe" name="tipe" required>
        <option value="">-- Pilih Tipe --</option>
        <?php foreach ($organizationTypes as $type): ?>
            <option value="<?= esc($type['name']) ?>"><?= esc($type['name']) ?></option>
        <?php endforeach; ?>
    </select>
</div>


            <div class="mb-3">
                <label for="urutan" class="form-label">Urutan</label>
                <input type="number" class="form-control" id="urutan" name="urutan">
            </div>

            <div class="mb-3" id="parent_id_wrapper" style="display: none;">
                <label for="parent_id" class="form-label">Induk Organisasi (Jurusan)*</label>
                <select class="form-select" id="parent_id" name="parent_id">
                    <option value="">-- Pilih Jurusan --</option>
                    <?php foreach ($organizations as $org): ?>
                        <option value="<?= $org['id'] ?>"><?= esc($org['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('/organisasi/units') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script>
        const typeSelect = document.getElementById('tipe');
        const parentWrapper = document.getElementById('parent_id_wrapper');

        typeSelect.addEventListener('change', function() {
            if (this.value === 'Program Studi') {
                parentWrapper.style.display = 'block';
            } else {
                parentWrapper.style.display = 'none';
            }
        });

        // Trigger on page load if needed
        if (typeSelect.value === 'Program Studi') {
            parentWrapper.style.display = 'block';
        }
    </script>
</body>

</html>