<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna - Tracer Study Admin Panel</title>
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

        .error-message {
            color: #dc3545;
            font-size: 0.875em;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <h2 class="mb-4">Tambah Pengguna Baru</h2>

        <!-- Tampilkan error validasi -->
        <?php if (session()->has('errors')): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger">
                <?= esc(session('error')) ?>
            </div>
        <?php endif ?>

        <form action="<?= site_url('users/store') ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="current_role" value="<?= $currentRole ?? '' ?>">

            <!-- Bagian Akun -->
            <div class="form-section">
                <h5>Informasi Akun</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label required-field">E-mail</label>
                        <input type="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>"
                            id="email" name="email" value="<?= old('email') ?>" required>
                        <?php if (session('errors.email')): ?>
                            <div class="error-message"><?= session('errors.email') ?></div>
                        <?php endif ?>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label required-field">Username</label>
                        <input type="text" class="form-control <?= session('errors.username') ? 'is-invalid' : '' ?>"
                            id="username" name="username" value="<?= old('username') ?>" required>
                        <?php if (session('errors.username')): ?>
                            <div class="error-message"><?= session('errors.username') ?></div>
                        <?php endif ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="group" class="form-label required-field">Grup Pengguna</label>
                        <select class="form-control <?= session('errors.group') ? 'is-invalid' : '' ?>"
                            id="group" name="group" required>
                            <option value="">- Pilih Grup -</option>
                            <option value="site_admin" <?= old('group') == 'site_admin' ? 'selected' : '' ?>>Site Admin</option>
                            <option value="admin_jurusan" <?= old('group') == 'admin_jurusan' ? 'selected' : '' ?>>Admin Jurusan</option>
                            <option value="alumni" <?= old('group') == 'alumni' ? 'selected' : '' ?>>Alumni</option>
                        </select>
                        <?php if (session('errors.group')): ?>
                            <div class="error-message"><?= session('errors.group') ?></div>
                        <?php endif ?>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="0" <?= old('status', '1') == '0' ? 'selected' : '' ?>>Tidak Aktif</option>
                            <option value="1" <?= old('status', '1') == '1' ? 'selected' : '' ?>>Aktif</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label required-field">Password</label>
                        <input type="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>"
                            id="password" name="password" required>
                        <?php if (session('errors.password')): ?>
                            <div class="error-message"><?= session('errors.password') ?></div>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <!-- Bagian Detail Pengguna -->
            <div id="detailPenggunaSection" class="form-section">
                <h5>Detail Pengguna</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label required-field">Nama Lengkap</label>
                        <input type="text" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>"
                            id="nama" name="nama" value="<?= old('nama') ?>" required>
                        <?php if (session('errors.nama')): ?>
                            <div class="error-message"><?= session('errors.nama') ?></div>
                        <?php endif ?>
                    </div>
                </div>

                <!-- Khusus Admin Jurusan dan Alumni -->
                <div id="departmentFields" style="display: none;">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="jurusan" class="form-label required-field">Jurusan</label>
                            <select class="form-control <?= session('errors.jurusan') ? 'is-invalid' : '' ?>"
                                id="jurusan" name="jurusan">
                                <option value="">- Pilih Jurusan -</option>
                                <?php foreach ($departments as $dept): ?>
                                    <option value="<?= $dept['id'] ?>"
                                        <?= old('jurusan') == $dept['id'] ? 'selected' : '' ?>>
                                        <?= $dept['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (session('errors.jurusan')): ?>
                                <div class="error-message"><?= session('errors.jurusan') ?></div>
                            <?php endif ?>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="program_studi" class="form-label required-field">Program Studi</label>
                            <select class="form-control <?= session('errors.program_studi') ? 'is-invalid' : '' ?>"
                                id="program_studi" name="program_studi"
                                <?= !old('jurusan') ? 'disabled' : '' ?>>
                                <option value="">- Pilih Program Studi -</option>
                                <?php if (old('jurusan') && $studyPrograms): ?>
                                    <?php foreach ($studyPrograms as $prodi): ?>
                                        <option value="<?= $prodi['id'] ?>"
                                            <?= old('program_studi') == $prodi['id'] ? 'selected' : '' ?>>
                                            <?= $prodi['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <?php if (session('errors.program_studi')): ?>
                                <div class="error-message"><?= session('errors.program_studi') ?></div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>

                <!-- Khusus Alumni -->
                <div id="alumniFields" style="display: none;">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="nim" class="form-label required-field">NIM</label>
                            <input type="text" class="form-control <?= session('errors.nim') ? 'is-invalid' : '' ?>"
                                id="nim" name="nim" value="<?= old('nim') ?>">
                            <?php if (session('errors.nim')): ?>
                                <div class="error-message"><?= session('errors.nim') ?></div>
                            <?php endif ?>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="angkatan" class="form-label required-field">Angkatan</label>
                            <select class="form-control <?= session('errors.angkatan') ? 'is-invalid' : '' ?>"
                                id="angkatan" name="angkatan">
                                <option value="">- Pilih Angkatan -</option>
                                <?php for ($i = date('Y'); $i >= date('Y') - 10; $i--): ?>
                                    <option value="<?= $i ?>" <?= old('angkatan') == $i ? 'selected' : '' ?>>
                                        <?= $i ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                            <?php if (session('errors.angkatan')): ?>
                                <div class="error-message"><?= session('errors.angkatan') ?></div>
                            <?php endif ?>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="tahun_kelulusan" class="form-label required-field">Tahun Kelulusan</label>
                            <select class="form-control <?= session('errors.tahun_kelulusan') ? 'is-invalid' : '' ?>"
                                id="tahun_kelulusan" name="tahun_kelulusan">
                                <option value="">- Pilih Tahun -</option>
                                <?php for ($i = date('Y'); $i >= date('Y') - 10; $i--): ?>
                                    <option value="<?= $i ?>" <?= old('tahun_kelulusan') == $i ? 'selected' : '' ?>>
                                        <?= $i ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                            <?php if (session('errors.tahun_kelulusan')): ?>
                                <div class="error-message"><?= session('errors.tahun_kelulusan') ?></div>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="ipk" class="form-label">IPK</label>
                            <input type="number" step="0.01" min="0" max="4" class="form-control <?= session('errors.ipk') ? 'is-invalid' : '' ?>"
                                id="ipk" name="ipk" value="<?= old('ipk') ?>">
                            <?php if (session('errors.ipk')): ?>
                                <div class="error-message"><?= session('errors.ipk') ?></div>
                            <?php endif ?>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="jenis_kelamin" class="form-label required-field">Jenis Kelamin</label>
                            <select class="form-control <?= session('errors.jenis_kelamin') ? 'is-invalid' : '' ?>"
                                id="jenis_kelamin" name="jenis_kelamin">
                                <option value="">- Pilih Jenis Kelamin -</option>
                                <option value="L" <?= old('jenis_kelamin') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="P" <?= old('jenis_kelamin') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                            <?php if (session('errors.jenis_kelamin')): ?>
                                <div class="error-message"><?= session('errors.jenis_kelamin') ?></div>
                            <?php endif ?>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="no_hp" class="form-label">No. HP</label>
                            <input type="text" class="form-control <?= session('errors.no_hp') ? 'is-invalid' : '' ?>"
                                id="no_hp" name="no_hp" value="<?= old('no_hp') ?>">
                            <?php if (session('errors.no_hp')): ?>
                                <div class="error-message"><?= session('errors.no_hp') ?></div>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="alamat1" class="form-label">Alamat 1</label>
                            <input type="text" class="form-control <?= session('errors.alamat1') ? 'is-invalid' : '' ?>"
                                id="alamat1" name="alamat1" value="<?= old('alamat1') ?>">
                            <?php if (session('errors.alamat1')): ?>
                                <div class="error-message"><?= session('errors.alamat1') ?></div>
                            <?php endif ?>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="alamat2" class="form-label">Alamat 2</label>
                            <input type="text" class="form-control <?= session('errors.alamat2') ? 'is-invalid' : '' ?>"
                                id="alamat2" name="alamat2" value="<?= old('alamat2') ?>">
                            <?php if (session('errors.alamat2')): ?>
                                <div class="error-message"><?= session('errors.alamat2') ?></div>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="kota" class="form-label">Kota</label>
                            <input type="text" class="form-control <?= session('errors.kota') ? 'is-invalid' : '' ?>"
                                id="kota" name="kota" value="<?= old('kota') ?>">
                            <?php if (session('errors.kota')): ?>
                                <div class="error-message"><?= session('errors.kota') ?></div>
                            <?php endif ?>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <input type="text" class="form-control <?= session('errors.provinsi') ? 'is-invalid' : '' ?>"
                                id="provinsi" name="provinsi" value="<?= old('provinsi') ?>">
                            <?php if (session('errors.provinsi')): ?>
                                <div class="error-message"><?= session('errors.provinsi') ?></div>
                            <?php endif ?>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="kodepos" class="form-label">Kode Pos</label>
                            <input type="text" class="form-control <?= session('errors.kodepos') ? 'is-invalid' : '' ?>"
                                id="kodepos" name="kodepos" value="<?= old('kodepos') ?>">
                            <?php if (session('errors.kodepos')): ?>
                                <div class="error-message"><?= session('errors.kodepos') ?></div>
                            <?php endif ?>
                        </div>


                        <!-- Tambahkan checkbox untuk surveyor -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_surveyor" name="is_surveyor" value="1" <?= old('is_surveyor') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="is_surveyor">
                                        Jadikan sebagai Surveyor
                                    </label>
                                </div>
                                <small class="text-muted">Jika dicentang, alumni ini akan muncul di halaman kontak surveyor</small>
                            </div>
                        </div>
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
            // Set nilai awal berdasarkan old input
            const initialGroup = '<?= old("group") ?>';
            if (initialGroup) {
                $('#group').val(initialGroup).trigger('change');
            }

            // Tampilkan detail pengguna berdasarkan grup
            $('#group').change(function() {
                const selectedGroup = $(this).val();

                // Reset semua field tambahan
                $('#departmentFields, #alumniFields').hide();
                $('#departmentFields select, #alumniFields input, #alumniFields select').prop('required', false);

                if (selectedGroup === 'admin_jurusan') {
                    $('#departmentFields').show();
                    $('#jurusan, #program_studi').prop('required', true);
                } else if (selectedGroup === 'alumni') {
                    $('#departmentFields, #alumniFields').show();
                    $('#jurusan, #program_studi, #nim, #angkatan, #tahun_kelulusan, #jenis_kelamin').prop('required', true);
                }
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

                            // Set nilai old jika ada
                            const oldProdi = '<?= old("program_studi") ?>';
                            if (oldProdi) {
                                programSelect.val(oldProdi);
                            }
                        });
                } else {
                    programSelect.prop('disabled', true);
                }
            });
        });
    </script>
</body>

</html>