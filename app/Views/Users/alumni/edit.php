<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Data Alumni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h3 class="mb-4">Edit Data Alumni</h3>

        <form action="<?= site_url('alumni/update/' . $alumni['id']) ?>" method="post">
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <strong>Informasi Dasar</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nim" class="form-label">NIM *</label>
                                <input type="text" class="form-control" id="nim" name="nim" value="<?= esc($alumni['nim']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label">Username *</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?= esc($alumni['username']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= esc($alumni['email']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama *</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= esc($alumni['nama']) ?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Jurusan *</label>
                                <select name="jurusan_id" id="jurusan" class="form-select" required>
                                    <option value="">- Pilih Jurusan -</option>
                                    <?php foreach ($jurusan as $item): ?>
                                        <option value="<?= esc($item['id']) ?>"
                                            <?= ($alumni['jurusan'] == $item['id'] || $alumni['jurusan'] == $item['name']) ? 'selected' : '' ?>>
                                            <?= esc($item['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Program Studi *</label>
                                <select name="program_studi_id" id="program_studi" class="form-select" required>
                                    <option value="">- Pilih Program Studi -</option>
                                    <?php foreach ($program_studi as $item): ?>
                                        <option value="<?= esc($item['id']) ?>"
                                            data-jurusan="<?= esc($item['parent_id']) ?>"
                                            class="program-option"
                                            <?= ($alumni['program_studi'] == $item['id'] || $alumni['program_studi'] == $item['name']) ? 'selected' : '' ?>>
                                            <?= esc($item['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="angkatan" class="form-label">Angkatan *</label>
                                <select name="angkatan" class="form-select" required>
                                    <option value="">- Pilih Angkatan -</option>
                                    <?php for ($year = date('Y'); $year >= 1990; $year--): ?>
                                        <option value="<?= $year ?>" <?= $alumni['angkatan'] == $year ? 'selected' : '' ?>>
                                            <?= $year ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-light">
                    <strong>Informasi Tambahan</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">IPK</label>
                                <input type="text" name="ipk" class="form-control" value="<?= esc($alumni['ipk'] ?? '') ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tahun Kelulusan *</label>
                                <input type="number" name="tahun_kelulusan" class="form-control" required value="<?= esc($alumni['tahun_kelulusan'] ?? '') ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin *</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="Laki-laki" <?= ($alumni['jenis_kelamin'] ?? '') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="Perempuan" <?= ($alumni['jenis_kelamin'] ?? '') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">No HP *</label>
                                <input type="text" name="no_hp" class="form-control" required value="<?= esc($alumni['no_hp'] ?? '') ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="Tidak Aktif" <?= ($alumni['status'] ?? '') == 'inactive' ? 'selected' : '' ?>>Tidak Aktif</option>
                                    <option value="Aktif" <?= ($alumni['status'] ?? '') == 'active' ? 'selected' : '' ?>>Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat 1</label>
                        <input type="text" name="alamat1" class="form-control" value="<?= esc($alumni['alamat1'] ?? '') ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat 2</label>
                        <input type="text" name="alamat2" class="form-control" value="<?= esc($alumni['alamat2'] ?? '') ?>">
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Kota</label>
                                <input type="text" name="kota" class="form-control" value="<?= esc($alumni['kota'] ?? '') ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Provinsi</label>
                                <select name="provinsi" class="form-select">
                                    <option value="">- Pilih Provinsi -</option>
                                    <option value="Jawa Barat" <?= ($alumni['provinsi'] ?? '') == 'Jawa Barat' ? 'selected' : '' ?>>Jawa Barat</option>
                                    <option value="Jawa Tengah" <?= ($alumni['provinsi'] ?? '') == 'Jawa Tengah' ? 'selected' : '' ?>>Jawa Tengah</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Kode Pos</label>
                                <input type="text" name="kodepos" class="form-control" value="<?= esc($alumni['kodepos'] ?? '') ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hak Supervisi -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <strong>Hak Supervisi</strong>
                </div>
                <div class="card-body">
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="hak_supervisi" name="hak_supervisi" value="1" <?= ($alumni['hak_supervisi'] ?? 0) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="hak_supervisi">Aktifkan Hak Supervisi</label>
                    </div>

                    <div id="supervisi_options" style="display: <?= ($alumni['hak_supervisi'] ?? 0) ? 'block' : 'none' ?>;">
                        <div class="mb-3">
                            <label class="form-label">Kategori Supervisi</label>
                            <select id="kategori_supervisi" name="kategori_supervisi" class="form-select">
                                <option value="">Pilih Kategori</option>
                                <option value="academic_faculty" <?= ($alumni['kategori_supervisi'] ?? '') == 'academic_faculty' ? 'selected' : '' ?>>Fakultas</option>
                                <option value="academic_program" <?= ($alumni['kategori_supervisi'] ?? '') == 'academic_program' ? 'selected' : '' ?>>Program Studi</option>
                                <option value="academic_year" <?= ($alumni['kategori_supervisi'] ?? '') == 'academic_year' ? 'selected' : '' ?>>Tahun Akademik</option>
                                <option value="academic_graduate_year" <?= ($alumni['kategori_supervisi'] ?? '') == 'academic_graduate_year' ? 'selected' : '' ?>>Tahun Kelulusan</option>
                            </select>
                        </div>

                        <div id="faculty_options" style="display: <?= ($alumni['kategori_supervisi'] ?? '') == 'academic_faculty' ? 'block' : 'none' ?>;">
                            <label class="form-label">Fakultas</label>
                            <select name="supervisi_faculty" class="form-select">
                                <option value="">Pilih Fakultas</option>
                                <?php foreach ($jurusan as $item): ?>
                                    <option value="<?= $item['id'] ?>" <?= ($alumni['supervisi_faculty'] ?? '') == $item['id'] ? 'selected' : '' ?>>
                                        <?= $item['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div id="program_options" style="display: <?= ($alumni['kategori_supervisi'] ?? '') == 'academic_program' ? 'block' : 'none' ?>;">
                            <label class="form-label">Program Studi</label>
                            <select name="supervisi_program_studi" class="form-select">
                                <option value="">Pilih Program Studi</option>
                                <?php foreach ($program_studi as $item): ?>
                                    <option value="<?= $item['id'] ?>" <?= ($alumni['supervisi_program_studi'] ?? '') == $item['id'] ? 'selected' : '' ?>>
                                        <?= $item['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div id="year_options" style="display: <?= ($alumni['kategori_supervisi'] ?? '') == 'academic_year' ? 'block' : 'none' ?>;">
                            <label class="form-label">Tahun Akademik</label>
                            <select name="supervisi_academic_year" id="academic_year" class="form-select">
                                <option value="">Pilih Tahun Akademik</option>
                                <?php for ($year = date('Y'); $year >= 1990; $year--): ?>
                                    <option value="<?= $year ?>" <?= ($alumni['supervisi_academic_year'] ?? '') == $year ? 'selected' : '' ?>>
                                        <?= $year ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div id="graduate_year_options" style="display: <?= ($alumni['kategori_supervisi'] ?? '') == 'academic_graduate_year' ? 'block' : 'none' ?>;">
                            <label class="form-label">Tahun Kelulusan</label>
                            <select name="supervisi_graduate_year" id="academic_graduate_year" class="form-select">
                                <option value="">Pilih Tahun Kelulusan</option>
                                <?php for ($year = date('Y'); $year >= 1990; $year--): ?>
                                    <option value="<?= $year ?>" <?= ($alumni['supervisi_graduate_year'] ?? '') == $year ? 'selected' : '' ?>>
                                        <?= $year ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <a href="/alumni" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter program studi berdasarkan jurusan
            const jurusanSelect = document.getElementById('jurusan');
            const prodiSelect = document.getElementById('program_studi');
            
            jurusanSelect.addEventListener('change', function() {
                const selectedJurusanId = this.value;
                const prodiOptions = prodiSelect.querySelectorAll('.program-option');
                
                // Sembunyikan semua opsi terlebih dahulu
                prodiOptions.forEach(option => {
                    option.style.display = 'none';
                });
                
                // Tampilkan hanya yang sesuai dengan jurusan terpilih
                prodiOptions.forEach(option => {
                    if (option.dataset.jurusan === selectedJurusanId || selectedJurusanId === '') {
                        option.style.display = '';
                    }
                });
                
                // Reset pilihan program studi jika tidak sesuai dengan jurusan terpilih
                const selectedProdi = prodiSelect.querySelector('option:checked');
                if (selectedProdi && selectedProdi.dataset.jurusan !== selectedJurusanId) {
                    prodiSelect.value = '';
                }
            });
            
            // Trigger change event saat pertama kali load jika jurusan sudah dipilih
            if (jurusanSelect.value) {
                jurusanSelect.dispatchEvent(new Event('change'));
            }

            // Hak supervisi toggle
            const hakSupervisi = document.getElementById('hak_supervisi');
            const supervisiOptions = document.getElementById('supervisi_options');
            
            hakSupervisi.addEventListener('change', function() {
                supervisiOptions.style.display = this.checked ? 'block' : 'none';
                if (!this.checked) {
                    document.getElementById('kategori_supervisi').value = '';
                    document.querySelectorAll('#faculty_options, #program_options, #year_options, #graduate_year_options').forEach(el => {
                        el.style.display = 'none';
                    });
                }
            });

            // Kategori supervisi change
            const kategoriSupervisi = document.getElementById('kategori_supervisi');
            
            kategoriSupervisi.addEventListener('change', function() {
                const selectedCategory = this.value;
                
                // Hide all options first
                document.querySelectorAll('#faculty_options, #program_options, #year_options, #graduate_year_options').forEach(el => {
                    el.style.display = 'none';
                });
                
                // Show selected option
                if (selectedCategory === 'academic_faculty') {
                    document.getElementById('faculty_options').style.display = 'block';
                } else if (selectedCategory === 'academic_program') {
                    document.getElementById('program_options').style.display = 'block';
                } else if (selectedCategory === 'academic_year') {
                    document.getElementById('year_options').style.display = 'block';
                } else if (selectedCategory === 'academic_graduate_year') {
                    document.getElementById('graduate_year_options').style.display = 'block';
                }
            });
        });
    </script>
</body>
</html>