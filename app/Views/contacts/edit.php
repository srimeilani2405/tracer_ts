<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kontak</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 25px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
            transition: all 0.3s;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.3);
        }

        .btn-group {
            margin-top: 25px;
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s;
            flex: 1;
            text-align: center;
        }

        .btn-submit {
            background-color: #3498db;
            color: white;
        }

        .btn-submit:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .btn-cancel {
            background-color: #95a5a6;
            color: white;
            text-decoration: none;
            line-height: normal;
        }

        .btn-cancel:hover {
            background-color: #7f8c8d;
            transform: translateY(-2px);
        }

        .error-messages {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 25px;
            border: 1px solid #f5c6cb;
        }

        .error-messages ul {
            margin: 0;
            padding-left: 20px;
        }

        .error-messages li {
            margin-bottom: 5px;
        }

        .checkbox-group {
            margin-top: 10px;
            display: flex;
            align-items: center;
        }

        .checkbox-group input[type="checkbox"] {
            width: auto;
            margin-right: 10px;
        }

        .checkbox-group label {
            margin-bottom: 0;
            font-weight: normal;
        }

        .conditional-field {
            display: none;
        }

        @media (max-width: 768px) {
            .container {
                margin: 15px;
                padding: 15px;
            }

            .btn-group {
                flex-direction: column;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Edit Kontak</h2>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="error-messages" role="alert" aria-live="polite">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/contacts/update/' . esc($contact['id'])) ?>" method="post" id="contactForm">
            <?= csrf_field() ?>

            <!-- Tahun -->
            <div class="form-group">
                <label for="tahun">Tahun *</label>
                <select name="tahun" id="tahun" required>
                    <option value="">-- Pilih Tahun --</option>
                    <?php foreach ($tahunOptions as $tahun): ?>
                        <?php if ((int)$tahun >= 2000): ?>
                            <option value="<?= esc($tahun) ?>" <?= old('tahun', $contact['tahun'] ?? '') == $tahun ? 'selected' : '' ?>>
                                <?= esc($tahun) ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Tipe Kontak -->
            <div class="form-group">
                <label for="contact_type">Tipe Kontak *</label>
                <select name="contact_type" id="contact_type" required>
                    <option value="">-- Pilih Tipe --</option>
                    <?php foreach ($contactTypes as $key => $label): ?>
                        <option value="<?= esc($key) ?>" <?= old('contact_type', $contact['contact_type'] ?? '') == $key ? 'selected' : '' ?>>
                            <?= esc($label) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Posisi -->
            <div class="form-group">
                <label for="position">Posisi/Jabatan *</label>
                <input type="text" name="position" id="position" value="<?= old('position', esc($contact['position'] ?? '')) ?>" required readonly>
            </div>

            <!-- Alumni -->
            <div class="form-group conditional-field" id="alumni-group">
                <label for="alumni_id">Pilih Alumni *</label>
                <select name="alumni_id" id="alumni_id">
                    <option value="">-- Pilih Alumni --</option>
                    <?php if (!empty($contact['alumni_id'])): ?>
                        <option value="<?= esc($contact['alumni_id']) ?>" selected>
                            <?= esc($contact['alumni_name'] ?? 'Alumni Terpilih') ?>
                        </option>
                    <?php endif; ?>
                </select>
                <small class="text-muted">Hanya menampilkan alumni dengan tahun kelulusan yang dipilih</small>
            </div>

            <!-- Jurusan -->
            <div class="form-group conditional-field" id="jurusan-group">
                <label for="jurusan">Jurusan *</label>
                <select name="jurusan" id="jurusan">
                    <option value="">-- Pilih Jurusan --</option>
                    <?php foreach ($jurusanOptions as $jurusan): ?>
                        <option value="<?= esc($jurusan['name']) ?>" <?= old('jurusan', $contact['jurusan'] ?? '') == $jurusan['name'] ? 'selected' : '' ?>>
                            <?= esc($jurusan['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Program Studi -->
            <div class="form-group conditional-field" id="program-studi-group">
                <label for="program_studi">Program Studi</label>
                <input type="text" name="program_studi" id="program_studi" value="<?= old('program_studi', esc($contact['program_studi'] ?? '')) ?>" readonly>
            </div>

            <!-- Nama -->
            <div class="form-group">
                <label for="name">Nama *</label>
                <input type="text" name="name" id="name" value="<?= old('name', esc($contact['name'] ?? '')) ?>" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" name="email" id="email" value="<?= old('email', esc($contact['email'] ?? '')) ?>" required>
                <div class="checkbox-group">
                    <input type="checkbox" name="show_email" id="show_email" value="1" <?= old('show_email', $contact['show_email'] ?? '') ? 'checked' : '' ?>>
                    <label for="show_email">Tampilkan email di halaman tracer/kontak</label>
                </div>
            </div>

            <!-- Telepon -->
            <div class="form-group">
                <label for="phone">Telepon *</label>
                <input type="text" name="phone" id="phone" value="<?= old('phone', esc($contact['phone'] ?? '')) ?>" required>
                <div class="checkbox-group">
                    <input type="checkbox" name="show_phone" id="show_phone" value="1" <?= old('show_phone', $contact['show_phone'] ?? '') ? 'checked' : '' ?>>
                    <label for="show_phone">Tampilkan telepon di halaman tracer/kontak</label>
                </div>
            </div>

            <!-- Kualifikasi -->
            <div class="form-group">
                <label for="qualification">Kualifikasi</label>
                <input type="text" name="qualification" id="qualification" value="<?= old('qualification', esc($contact['qualification'] ?? '')) ?>">
            </div>

            <!-- Urutan -->
            <div class="form-group">
                <label for="sort_order">Urutan Tampil *</label>
                <input type="number" name="sort_order" id="sort_order" value="<?= old('sort_order', esc($contact['sort_order'] ?? 0)) ?>" min="0" required>
            </div>

            <!-- Tombol -->
            <div class="btn-group">
                <button type="submit" class="btn btn-submit">Simpan Perubahan</button>
                <a href="<?= base_url('/contacts') ?>" class="btn btn-cancel">Batal</a>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            function updateFormState() {
                const contactType = $('#contact_type').val();
                const tahun = $('#tahun').val();

                // Sembunyikan semua
                $('.conditional-field').hide().find('select, input').prop('required', false);

                if (contactType && tahun) {
                    if (contactType === 'surveyor') {
                        $('#position').val('Surveyor Tahun ' + tahun);
                        $('#alumni-group').show();
                        $('#alumni_id').prop('required', true);
                        $('#program-studi-group').show();
                        loadAlumniByTahun(tahun);
                    } else if (contactType === 'coordinator') {
                        $('#position').val('Koordinator Surveyor Tahun ' + tahun);
                        $('#jurusan-group').show();
                        $('#jurusan').prop('required', true);
                    } else {
                        $('#position').val($('#contact_type option:selected').text());
                    }
                } else if (contactType) {
                    $('#position').val($('#contact_type option:selected').text());
                } else {
                    $('#position').val('');
                }
            }

            function loadAlumniByTahun(tahun) {
                if (!tahun) return;
                $.get('<?= base_url('/contacts/getAlumniByTahun') ?>', { tahun })
                    .done(function(data) {
                        const select = $('#alumni_id');
                        const currentAlumniId = '<?= $contact["alumni_id"] ?? "" ?>';
                        
                        if (currentAlumniId) {
                            // Keep the current selection if exists
                            select.empty();
                            select.append(`<option value="${currentAlumniId}" selected><?= esc($contact['alumni_name'] ?? 'Alumni Terpilih') ?></option>`);
                        } else {
                            select.empty().append('<option value="">-- Pilih Alumni --</option>');
                        }
                        
                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(alumni => {
                                if (alumni.id != currentAlumniId) {
                                    select.append(`<option value="${alumni.id}">${alumni.nama} - ${alumni.program_studi}</option>`);
                                }
                            });
                        } else if (!currentAlumniId) {
                            select.append('<option disabled>Tidak ada alumni untuk tahun ini</option>');
                        }
                    })
                    .fail(() => alert('Gagal memuat data alumni'));
            }

            function loadAlumniDetail(id) {
                if (!id) return;
                $.get('<?= base_url('/contacts/getAlumniDetail') ?>', { id })
                    .done(function(data) {
                        if (data) {
                            $('#name').val(data.nama ?? '');
                            $('#email').val(data.email ?? '');
                            $('#phone').val(data.no_hp ?? '');
                            $('#program_studi').val(data.program_studi ?? '');
                        }
                    })
                    .fail(() => alert('Gagal memuat detail alumni'));
            }

            // Initialize form state based on current contact data
            function initializeForm() {
                const contactType = '<?= $contact["contact_type"] ?? "" ?>';
                const tahun = '<?= $contact["tahun"] ?? "" ?>';
                
                if (contactType === 'surveyor') {
                    $('#alumni-group').show();
                    $('#program-studi-group').show();
                } else if (contactType === 'coordinator') {
                    $('#jurusan-group').show();
                }
            }

            $('#contact_type, #tahun').change(updateFormState);
            $('#alumni_id').change(function() {
                loadAlumniDetail($(this).val());
            });

            // Initialize form on page load
            updateFormState();
            initializeForm();
        });
    </script>
</body>
</html>