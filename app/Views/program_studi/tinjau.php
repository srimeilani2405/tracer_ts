<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Program Studi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h3><?= esc($program_studi['name']) ?></h3>

        <table class="table table-bordered">
            <tr>
                <th>Nama Program Studi</th>
                <td><?= esc($program_studi['name']) ?></td>
            </tr>
            <tr>
                <th>Satuan Induk (Jurusan)</th>
                <td>
                    <?= !empty($jurusan) ? esc($jurusan['name']) : '-' ?>
                </td>
            </tr>
            <tr>
                <th>Tipe</th>
                <td><?= esc($program_studi['tipe']) ?></td>
            </tr>
        </table>

        <a href="<?= base_url('/program_studi') ?>" class="btn btn-warning">Kembali</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>