<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Tracer Study</title>
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

        .content {
            padding: 50px 0;
        }

        .carousel img {
            border-radius: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3, #003d7a);
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="container-fluid header">
        <img src="<?= base_url('logoPANJANG.png') ?>" alt="Logo POLBAN">
    </div>

    <!-- Menu -->
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

    <!-- Konten -->
    <div class="container content">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="text-primary">Tracer Study</h2>
                <?php if (!empty($welcomeMessage)) : ?>
                    <p><?= esc($welcomeMessage) ?></p>
                <?php endif; ?>
                <a href="<?= base_url('login') ?>" class="btn btn-primary">Masuk Situs »</a>
            </div>
            <div class="col-md-6">
                <!-- Carousel -->
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?= base_url('assets/images/home/slide-01.jpg') ?>" class="d-block w-100" alt="slide-01">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url('assets/images/home/slide-02.jpg') ?>" class="d-block w-100" alt="slide-02">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url('assets/images/home/slide-05.jpg') ?>" class="d-block w-100" alt="slide-05">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Sebelumnya</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Berikutnya</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>