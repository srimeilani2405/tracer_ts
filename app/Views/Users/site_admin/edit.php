<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Site Admin</title>

    <!-- Link ke Bootstrap CSS (pastikan sudah tersedia di proyek atau pakai CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .required-field::after {
            content: " *";
            color: red;
        }

        .form-section h5 {
            color: #0d6efd;
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <h2 class="mb-4">Edit Site Admin</h2>

        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('/site_admin/update/' . $siteAdmin['id']) ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="form-section">
                        <h5>Informasi Akun</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label required-field">Username</label>
                                <input type="text" name="username" id="username"
                                    value="<?= esc($siteAdmin['username']) ?>" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label required-field">Nama</label>
                                <input type="text" name="nama" id="nama"
                                    value="<?= esc($siteAdmin['nama']) ?>" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label required-field">Email</label>
                                <input type="email" name="email" id="email"
                                    value="<?= esc($siteAdmin['email']) ?>" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="<?= base_url('/site_admin') ?>" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional, jika ada fitur interaktif seperti dropdown/modal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>