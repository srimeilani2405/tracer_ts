<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Program Studi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Tambah Program Studi</h2>

        <!-- Tampilkan error jika ada -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('/program_studi/store') ?>" method="post">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Program Studi</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="parent_id" class="form-label">Satuan Induk (Jurusan)</label>
                <select class="form-control" id="parent_id" name="parent_id">
                    <option value="">Pilih Jurusan</option>
                    <?php if (!empty($jurusan)): ?>
                        <?php foreach ($jurusan as $j): ?>
                            <option value="<?= esc($j['id']) ?>"><?= esc($j['name']) ?></option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">Jurusan tidak tersedia</option>
                    <?php endif; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="<?= base_url('/program_studi') ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>