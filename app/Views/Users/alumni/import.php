<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Pengguna</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Import Pengguna</h2>
        <p>Agar import pengguna dapat berjalan lancar dan mudah, pastikan dokumen CSV Anda memenuhi kriteria berikut:</p>
        <ul>
            <li>Fields wajib: Email, Password, Username, Display Name.</li>
            <li>Line dibatasi \n namun untuk baris terakhir tidak usah menggunakan.</li>
            <li>Jika nilai IPK memiliki koma (32,5) ganti dengan titik (32.5).</li>
        </ul>

        <a href="<?= base_url('alumni/download-template') ?>" class="btn btn-primary">Download Contoh CSV</a>


        <form action="<?= site_url('alumni/prosesImport') ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Pilih File</label>
                <input type="file" name="file" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Group</label>
                <select name="group" class="form-control">
                    <option value="">-- Pilih Group --</option>
                    <option value="alumni">Alumni</option>
                    <option value="site_admin">Site Admin</option>
                    <option value="admin_jurusan">Admin Jurusan</option>
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