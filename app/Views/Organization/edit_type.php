<!DOCTYPE html>
<html lang="id">

<head>
    <title>Edit Tipe Organisasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-4">
    <h2>Edit Tipe Organisasi</h2>
    <form action="<?= base_url('/organisasi/types/update/' . $type['id']) ?>" method="post">
        <div class="mb-3">
            <label>Nama Tipe:</label>
            <input type="text" name="name" value="<?= esc($type['name']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Level:</label>
            <input type="number" name="level" value="<?= esc($type['level']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi:</label>
            <textarea name="description" class="form-control"><?= esc($type['description']) ?></textarea>
        </div>
        <div class="mb-3">
            <label>Grup Tersedia:</label>
            <input type="text" name="available_group" value="<?= esc($type['available_group']) ?>" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('/organisasi/types') ?>" class="btn btn-secondary">Batal</a>
    </form>
</body>

</html>