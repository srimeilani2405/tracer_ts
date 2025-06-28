<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
        }

        .content {
            margin-left: 270px;
            padding: 20px;
            width: calc(100% - 270px);
        }
    </style>

    <!-- Dropdown Akun di Kanan Atas -->
    <div class="dropdown" style="position: absolute; top: 20px; right: 30px;">
        <button
            class="btn dropdown-toggle d-flex align-items-center"
            type="button"
            id="dropdownAkun"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            style="background-color: #a6b6d7; color: #fff; border: none; border-radius: 30px; padding: 8px 14px;">

            <img src="<?= base_url('assets/images/user.png') ?>" alt="User" width="30" height="30" class="rounded-circle me-2">

            <div class="text-start">
                <div style="font-size: 13px; font-weight: bold;">Administrator</div>
                <div style="font-size: 11px;">Site Admin</div>
            </div>
        </button>

        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownAkun">
            <li>
                <a class="dropdown-item" href="<?= base_url('profile') ?>">
                    <i class="bi bi-person-circle me-2"></i> Profile
                </a>
            </li>
            <li>
                <a class="dropdown-item text-danger" href="<?= base_url('tracer/home') ?>">
                    <i class="bi bi-box-arrow-right me-2"></i> Keluar
                </a>
            </li>
        </ul>
    </div>


    <!-- Bootstrap CSS & JS (pastikan sudah ada di atas/bawah) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>