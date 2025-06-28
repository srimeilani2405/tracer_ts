<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Program Studi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Program Studi</h2>

        <form action="<?= base_url('/program_studi/update/' . $program_studi['id']) ?>" method="post">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Program Studi</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= esc($program_studi['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="parent_id" class="form-label">Satuan Induk (Jurusan)</label>
                <select class="form-control" id="parent_id" name="parent_id">
                    <option value="">Pilih Jurusan</option>
                    <?php foreach ($jurusan as $j) : ?>
                        <option value="<?= $j['id'] ?>" <?= ($program_studi['parent_id'] == $j['id']) ? 'selected' : '' ?>>
                            <?= esc($j['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="<?= base_url('/program_studi') ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>