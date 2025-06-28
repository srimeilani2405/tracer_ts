<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Halaman Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-size: 14px;
            font-weight: bold;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }
        .btn {
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .alert {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .alert ul {
            margin: 0;
            padding-left: 20px;
        }
        .alert li {
            list-style-type: disc;
        }
        .button-group {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Halaman Baru</h1>

        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="alert">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('pages/store') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="title">Judul Halaman</label>
                <input type="text" name="title" id="title" value="<?= old('title') ?>" required>
            </div>

            <div class="form-group">
                <label for="content">Isi Halaman</label>
                <textarea name="content" id="content" rows="6" required><?= old('content') ?></textarea>
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= base_url('/pages') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
