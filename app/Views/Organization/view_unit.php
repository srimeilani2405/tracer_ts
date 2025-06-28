<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Satuan Organisasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table th {
            width: 25%;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3><?= esc($organization['name']) ?></h3>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Nama Satuan Organisasi</th>
                        <td><?= esc($organization['name']) ?></td>
                    </tr>
                    <tr>
                        <th>Singkatan</th>
                        <td><?= esc($organization['short_name'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td><?= esc($organization['slug'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td><?= esc($organization['description'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <th>Tipe</th>
                        <td><?= esc($organization['tipe']) ?></td>
                    </tr>
                    <tr>
                        <th>Urutan</th>
                        <td><?= esc($organization['urutan'] ?? '-') ?></td>
                    </tr>
                    <tr>
    <th>Satuan Induk</th>
    <td>
        <?php if ($parent): ?>
            <?= esc($parent['name']) ?>
        <?php else: ?>
            -
        <?php endif; ?>
    </td>
</tr>

                    <tr>
                        <th>Dibuat Pada</th>
                        <td><?= date('d F Y H:i', strtotime($organization['created_at'])) ?></td>
                    </tr>
                    <tr>
                        <th>Diperbarui Pada</th>
                        <td><?= date('d F Y H:i', strtotime($organization['updated_at'])) ?></td>
                    </tr>
                </table>

                <div class="mt-3">
                    <a href="<?= base_url('/organisasi/edit/' . $organization['id']) ?>" class="btn btn-warning">Edit</a>
                    <a href="<?= base_url('/organisasi/units') ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>