<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Pengguna Site Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Import Pengguna Site Admin</h2>
        <p>Pastikan file CSV Anda memiliki struktur yang benar. Kolom yang diperlukan adalah:</p>
        <ul>
            <li><strong>Username</strong>, <strong>Nama</strong>, <strong>Email</strong></li>
        </ul>

        <a href="<?= base_url('site_admin/download-template') ?>" class="btn btn-primary">Download Contoh CSV</a>

        <form action="<?= base_url('site_admin/prosesImport') ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Pilih File</label>
                <input type="file" name="file" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Group</label>
                <select name="group" class="form-control">
                    <option value="site_admin">Site Admin</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Aktifkan</label>
                <select name="status" class="form-control">
                    <option value="inactive">Inactive</option>
                    <option value="active">Active</option>
                </select>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="skip_header" checked>
                <label class="form-check-label">Lewatkan Header</label>
            </div>
            <button type="submit" class="btn btn-success mt-3">Import Pengguna</button>
        </form>
    </div>
</body>

</html>
