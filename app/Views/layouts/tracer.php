<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Tracer Study POLBAN' ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .header {
            background-color: white;
            padding: 20px 0;
            text-align: center;
        }

        .header img {
            max-width: 100%;
            height: auto;
        }

        .navbar {
            background-color: #0e5ca8 !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav .nav-link {
            color: white !important;
            font-weight: bold;
            margin-right: 15px;
        }

        .navbar-nav .nav-link.active {
            background-color: #0b4c8b;
            border-radius: 0 0 8px 8px;
            padding: 10px 15px;
        }

        .main-content {
            padding: 20px;
        }

        .container-content {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #0066cc;
            font-size: 24px;
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="container-fluid header">
        <img src="<?= base_url('logoPANJANG.png') ?>" alt="Logo POLBAN">
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>">Home</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('tracer-study/kontak') ?>">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('tracer-study/tentang') ?>">Tentang</a></li>
                <li class="nav-item mx-2">
                    <a class="nav-link" id="nav-tracer" href="https://penelusuranalumni.polban.ac.id/kuesioner/kuesioner/hasil">Respon TS</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" id="nav-tracer" href="https://penelusuranalumni.polban.ac.id/kuesioner/kuesioner/laporan">Laporan TS</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h1>Tracer Study</h1>
            <?= $this->renderSection('content') ?>
        </div>
    </div>

</body>
</html>
