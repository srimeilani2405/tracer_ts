</html><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detil Kuesioner - Tracer Study</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar Atas -->
    <nav class="navbar navbar-light bg-light px-3">
        <span>Administrator | <a href="<?= base_url('kuesioner/index') ?>"> Admin Panel</a> | <a href="#">Profil</a> | <a href="#">Keluar</a></span>
    </nav>

    <!-- Navbar Utama -->
    <nav class="navbar navbar-expand-lg navbar-primary bg-primary">
        <div class="container">
            <a class="navbar-brand text-white" href="#">Tracer Study</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-white" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Tentang</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="text-primary">Detil Kuesioner</h2>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>ID: 43 - Halaman 1</h5>
            </div>
            <div class="card-body">
                <p>Halaman ini berisi pertanyaan tentang data diri dan pekerjaan Anda. Mohon untuk mengisi semua data yang diminta. Terima kasih.</p>
                
                <!-- Dropdown Halaman -->
                <form method="GET" action="#">
                    <label for="halaman"><strong>Pilih Halaman:</strong></label>
                    <select name="halaman" id="halaman" class="form-select mb-3" onchange="this.form.submit()">
                        <option value="1" selected>Halaman 1</option>
                        <option value="2">Halaman 2</option>
                        <option value="3">Halaman 3</option>
                    </select>
                </form>

                <!-- Contoh Data Kuesioner -->
                <h5>Data Pribadi</h5>
                <p><em>Bagian ini berisi pertanyaan tentang data pribadi responden.</em></p>
                
                <div class="mb-3 p-2 bg-light border rounded">
                    <strong>1. Nama *</strong>
                    <input type="text" name="nama" class="form-control mt-2" placeholder="Masukkan nama Anda">
                </div>
                
                <div class="mb-3 p-2 bg-light border rounded">
                    <strong>2. Jenis Kelamin *</strong>
                    <br>
                    <input type="radio" name="gender" value="pria"> Pria
                    <input type="radio" name="gender" value="wanita"> Wanita
                </div>
            </div>
        </div>
    </div>
</body>
</html>