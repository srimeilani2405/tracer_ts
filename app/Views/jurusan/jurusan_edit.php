<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jurusan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
    <h2>Edit Jurusan</h2>

    <form action="<?= base_url('jurusan/update/' . $jurusan['id']) ?>" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Jurusan</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= esc($jurusan['name']) ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= base_url('/jurusan') ?>" class="btn btn-secondary">Batal</a>
    </form>
</body>

</html>