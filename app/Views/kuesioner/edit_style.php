<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Style</h1>
        <form action="/kuesioner/save-style/<?= esc($kuesioner['id']) ?>" method="post">
            <div class="form-group">
                <label for="font">Font</label>
                <input type="text" class="form-control" id="font" name="font" value="Arial">
            </div>
            <div class="form-group">
                <label for="color">Background Color</label>
                <input type="color" class="form-control" id="color" name="color" value="#FFFFFF">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/kuesioner" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>