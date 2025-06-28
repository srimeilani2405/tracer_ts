<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna - Tracer Study Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }

        .form-section h5 {
            margin-bottom: 1.5rem;
            color: #0d6efd;
        }

        .required-field::after {
            content: " *";
            color: red;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <h2 class="mb-4">Edit Pengguna</h2>

        <?php if (session()->has('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <form action="<?= site_url('users/update/' . $user['id']) ?>" method="post">
            <?= csrf_field() ?>

            <!-- Bagian Akun -->
            <div class="form-section">
                <h5>Informasi Akun</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label required-field">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required value="<?= old('email', $user['email']) ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label required-field">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required value="<?= old('username', $user['username']) ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="role" class="form-label required-field">Grup</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="">- Pilih Grup -</option>
                            <option value="site_admin" <?= old('role', $user['role']) == 'site_admin' ? 'selected' : '' ?>>Site Admin</option>
                            <option value="admin_jurusan" <?= old('role', $user['role']) == 'admin_jurusan' ? 'selected' : '' ?>>Admin Jurusan</option>
                            <option value="alumni" <?= old('role', $user['role']) == 'alumni' ? 'selected' : '' ?>>Alumni</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="0" <?= old('status', $user['status']) == '0' ? 'selected' : '' ?>>Tidak Aktif</option>
                            <option value="1" <?= old('status', $user['status'], '1') == '1' ? 'selected' : '' ?>>Aktif</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password (kosongkan jika tidak ingin mengubah)</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                </div>
            </div>

            <!-- Bagian Detail Pengguna -->
            <div id="detailPenggunaSection" class="form-section" style="display: <?= in_array($user['role'], ['admin_jurusan', 'alumni']) ? 'block' : 'none' ?>;">
                <h5>Detail Pengguna</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label required-field">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" required value="<?= old('nama', $user['nama']) ?>">
                    </div>
                </div>

                <!-- Khusus Admin Jurusan dan Alumni -->
                <div id="departmentFields" style="display: <?= in_array($user['role'], ['admin_jurusan', 'alumni']) ? 'block' : 'none' ?>;">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select class="form-control" id="jurusan" name="jurusan">
                                <option value="">- Pilih Jurusan -</option>
                                <?php foreach ($departments as $dept): ?>
                                    <option value="<?= $dept['id'] ?>" <?= old('jurusan', $user['jurusan']) == $dept['id'] ? 'selected' : '' ?>><?= $dept['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="program_studi" class="form-label">Program Studi</label>
                            <select class="form-control" id="program_studi" name="program_studi" <?= empty($user['jurusan']) ? 'disabled' : '' ?>>
                                <option value="">- Pilih Program Studi -</option>
                                <?php if (!empty($studyPrograms)): ?>
                                    <?php foreach ($studyPrograms as $prodi): ?>
                                        <option value="<?= $prodi['id'] ?>" <?= old('program_studi', $user['program_studi']) == $prodi['id'] ? 'selected' : '' ?>><?= $prodi['name'] ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Khusus Alumni -->
                <div id="alumniFields" style="display: <?= $user['role'] == 'alumni' ? 'block' : 'none' ?>;">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim" value="<?= old('nim', $user['nim']) ?>">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="angkatan" class="form-label">Angkatan</label>
                            <select class="form-control" id="angkatan" name="angkatan">
                                <option value="">- Pilih Angkatan -</option>
                                <?php for ($i = date('Y'); $i >= date('Y') - 10; $i--): ?>
                                    <option value="<?= $i ?>" <?= old('angkatan', $user['angkatan']) == $i ? 'selected' : '' ?>><?= $i ?></option>
                                <?php endfor; ?>
                                </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="ipk" class="form-label">IPK</label>
                            <input type="number" step="0.01" class="form-control" id="ipk" name="ipk" value="<?= old('ipk', $user['ipk']) ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="tahun_kelulusan" class="form-label">Tahun Kelulusan</label>
                            <select class="form-control" id="tahun_kelulusan" name="tahun_kelulusan">
                                <option value="">- Pilih Tahun Kelulusan -</option>
                                <?php for ($i = date('Y'); $i >= date('Y') - 10; $i--): ?>
                                    <option value="<?= $i ?>" <?= old('tahun_kelulusan', $user['tahun_kelulusan']) == $i ? 'selected' : '' ?>><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="">- Pilih Jenis Kelamin -</option>
                                <option value="L" <?= old('jenis_kelamin', $user['jenis_kelamin']) == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="P" <?= old('jenis_kelamin', $user['jenis_kelamin']) == 'P' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="no_hp" class="form-label">No. HP</label>
                            <input type="tel" class="form-control" id="no_hp" name="no_hp" value="<?= old('no_hp', $user['no_hp']) ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="alamat1" class="form-label">Alamat 1</label>
                            <input type="text" class="form-control" id="alamat1" name="alamat1" value="<?= old('alamat1', $user['alamat1']) ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="alamat2" class="form-label">Alamat 2</label>
                            <input type="text" class="form-control" id="alamat2" name="alamat2" value="<?= old('alamat2', $user['alamat2']) ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="kota" class="form-label">Kota</label>
                            <input type="text" class="form-control" id="kota" name="kota" value="<?= old('kota', $user['kota']) ?>">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <input type="text" class="form-control" id="provinsi" name="provinsi" value="<?= old('provinsi', $user['provinsi']) ?>">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="kodepos" class="form-label">Kode Pos</label>
                            <input type="text" class="form-control" id="kodepos" name="kodepos" value="<?= old('kodepos', $user['kodepos']) ?>">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hak Supervisi -->
            <div class="form-section">
                <h5>Hak Supervisi</h5>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="hak_supervisi" name="hak_supervisi" value="1" <?= old('hak_supervisi', $user['hak_supervisi'] ?? 0) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="hak_supervisi">Aktifkan Hak Supervisi</label>
                </div>

                <div id="supervisi_options" style="display: <?= old('hak_supervisi', $user['hak_supervisi'] ?? 0) ? 'block' : 'none' ?>;">
                    <div class="mb-3">
                        <label class="form-label">Kategori Supervisi</label>
                        <select id="kategori_supervisi" name="kategori_supervisi" class="form-select">
                            <option value="">Pilih Kategori</option>
                            <option value="academic_faculty" <?= old('kategori_supervisi', $user['kategori_supervisi'] ?? '') == 'academic_faculty' ? 'selected' : '' ?>>Fakultas</option>
                            <option value="academic_program" <?= old('kategori_supervisi', $user['kategori_supervisi'] ?? '') == 'academic_program' ? 'selected' : '' ?>>Program Studi</option>
                            <option value="academic_year" <?= old('kategori_supervisi', $user['kategori_supervisi'] ?? '') == 'academic_year' ? 'selected' : '' ?>>Tahun Akademik</option>
                            <option value="academic_graduate_year" <?= old('kategori_supervisi', $user['kategori_supervisi'] ?? '') == 'academic_graduate_year' ? 'selected' : '' ?>>Tahun Kelulusan</option>
                        </select>
                    </div>

                    <div id="faculty_options" style="display: <?= old('kategori_supervisi', $user['kategori_supervisi'] ?? '') == 'academic_faculty' ? 'block' : 'none' ?>;">
                        <label class="form-label">Fakultas</label>
                        <select name="supervisi_faculty" class="form-select">
                            <option value="">Pilih Fakultas</option>
                            <?php foreach ($departments as $dept): ?>
                                <option value="<?= $dept['id'] ?>" <?= old('supervisi_faculty', $user['supervisi_faculty'] ?? '') == $dept['id'] ? 'selected' : '' ?>>
                                    <?= $dept['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div id="program_options" style="display: <?= old('kategori_supervisi', $user['kategori_supervisi'] ?? '') == 'academic_program' ? 'block' : 'none' ?>;">
                        <label class="form-label">Program Studi</label>
                        <select name="supervisi_program_studi" class="form-select">
                            <option value="">Pilih Program Studi</option>
                            <?php foreach ($studyPrograms as $prodi): ?>
                                <option value="<?= $prodi['id'] ?>" <?= old('supervisi_program_studi', $user['supervisi_program_studi'] ?? '') == $prodi['id'] ? 'selected' : '' ?>>
                                    <?= $prodi['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div id="year_options" style="display: <?= old('kategori_supervisi', $user['kategori_supervisi'] ?? '') == 'academic_year' ? 'block' : 'none' ?>;">
                        <label class="form-label">Tahun Akademik</label>
                        <select name="supervisi_academic_year" id="academic_year" class="form-select">
                            <option value="">Pilih Tahun Akademik</option>
                            <?php for ($year = date('Y'); $year >= date('Y') - 10; $year--): ?>
                                <option value="<?= $year ?>" <?= old('supervisi_academic_year', $user['supervisi_academic_year'] ?? '') == $year ? 'selected' : '' ?>>
                                    <?= $year ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div id="graduate_year_options" style="display: <?= old('kategori_supervisi', $user['kategori_supervisi'] ?? '') == 'academic_graduate_year' ? 'block' : 'none' ?>;">
                        <label class="form-label">Tahun Kelulusan</label>
                        <select name="supervisi_graduate_year" id="academic_graduate_year" class="form-select">
                            <option value="">Pilih Tahun Kelulusan</option>
                            <?php for ($year = date('Y'); $year >= date('Y') - 10; $year--): ?>
                                <option value="<?= $year ?>" <?= old('supervisi_graduate_year', $user['supervisi_graduate_year'] ?? '') == $year ? 'selected' : '' ?>>
                                    <?= $year ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='<?= site_url('users') ?>'">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan & Tutup</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fungsi untuk menangani perubahan grup
            function handleroleChange(selectedrole) {
                $('#detailPenggunaSection').show();

                // Reset semua field tambahan
                $('#departmentFields, #alumniFields').hide();
                $('#departmentFields select, #alumniFields input, #alumniFields select').prop('required', false);

                // Tampilkan field sesuai grup
                if (selectedrole === 'admin_jurusan') {
                    $('#departmentFields').show();
                    $('#jurusan, #program_studi').prop('required', true);
                } else if (selectedrole === 'alumni') {
                    $('#departmentFields, #alumniFields').show();
                    $('#jurusan, #program_studi, #nim, #angkatan, #ipk, #tahun_kelulusan, #jenis_kelamin, #no_hp').prop('required', true);
                }
            }

            // Inisialisasi form berdasarkan grup yang sudah dipilih (jika ada error)
            const initialrole = '<?= old("role", $user["role"]) ?>';
            if (initialrole) {
                handleroleChange(initialrole);
            }

            // Tampilkan detail pengguna berdasarkan grup
            $('#role').change(function() {
                handleroleChange($(this).val());
            });

            // Dropdown jurusan -> program studi
            $('#jurusan').on('change', function() {
                const jurusanId = this.value;
                const programSelect = $('#program_studi');
                programSelect.html('<option value="">- Pilih Program Studi -</option>');

                if (jurusanId) {
                    fetch(`/get-programs/${jurusanId}`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(program => {
                                programSelect.append($('<option>', {
                                    value: program.id,
                                    text: program.name
                                }));
                            });
                            programSelect.prop('disabled', false);

                            // Set nilai sebelumnya jika ada
                            const oldProgram = '<?= old("program_studi", $user["program_studi"]) ?>';
                            if (oldProgram) {
                                programSelect.val(oldProgram);
                            }
                        });
                } else {
                    programSelect.prop('disabled', true);
                }
            });

            // Hak supervisi toggle
            $('#hak_supervisi').change(function() {
                $('#supervisi_options').toggle(this.checked);
                if (!this.checked) {
                    $('#kategori_supervisi').val('');
                    $('#faculty_options, #program_options, #year_options, #graduate_year_options').hide();
                }
            });

            // Kategori supervisi change
            $('#kategori_supervisi').change(function() {
                const selectedCategory = $(this).val();
                
                // Hide all options first
                $('#faculty_options, #program_options, #year_options, #graduate_year_options').hide();
                
                // Show selected option
                if (selectedCategory === 'academic_faculty') {
                    $('#faculty_options').show();
                } else if (selectedCategory === 'academic_program') {
                    $('#program_options').show();
                } else if (selectedCategory === 'academic_year') {
                    $('#year_options').show();
                } else if (selectedCategory === 'academic_graduate_year') {
                    $('#graduate_year_options').show();
                }
            });
        });
    </script>
</body>
</html>