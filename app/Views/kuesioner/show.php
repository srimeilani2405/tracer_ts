
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kuesioner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Detail Kuesioner</h2>
        <p><strong>Judul:</strong> <?= esc($kuesioner['title']) ?></p>
        <p><strong>Rules:</strong> <?= esc($kuesioner['rules']) ?></p>
        <p><strong>Status:</strong> <?= $kuesioner['active'] ? 'Aktif' : 'Tidak Aktif' ?></p>
        <a href="<?= base_url('/Kuesioner') ?>" class="btn btn-primary">Kembali</a>
    </div>
</body>
</html>