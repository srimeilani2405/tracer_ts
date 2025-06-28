<?= $this->extend('layouts/tracer') ?>
<?= $this->section('content') ?>

<div class="container mb-5">

    <?php if ($directorate): ?>
        <div class="mb-4">
            <p>
                <strong><?= esc($directorate['position']) ?></strong><br>
                <?= esc($directorate['name']) ?>
            </p>
        </div>
    <?php endif; ?>

    <?php if (!empty($team)): ?>
        <div class="mb-4">
            <p>
                <strong>Team <em>Tracer Study</em> POLBAN</strong><br>
                <?php foreach ($team as $member): ?>
                    <?= esc($member['name']) ?><br>
                <?php endforeach; ?>
            </p>
        </div>
    <?php endif; ?>

    <?php if (!empty($addressInfo)): ?>
        <?php $addr = $addressInfo[0]; ?>
        <div class="mb-4">
            <p>
                <strong><?= esc($addr['position']) ?></strong><br>
                <?= esc($addr['name']) ?><br>
                Telp: <?= esc($addr['phone']) ?><br>
                Fax: <?= esc($addr['qualification']) ?><br>
                Email: <?= esc($addr['email']) ?>
            </p>
        </div>
    <?php endif; ?>

    <!-- Surveyor Section -->
    <div class="mt-5">
        <p>
            <strong>Surveyor Tahun <?= $currentYear ?></strong><br>
            Pada Tahun <?= $currentYear ?> Tracer Study dilakukan kepada Alumni POLBAN yang lulus pada Tahun <?= $currentYear - 1 ?>.<br>
            Adapun nama-nama surveyor yang diangkat untuk membantu meningkatkan jumlah data yang masuk adalah sebagai berikut:
        </p>

        <?php if (!empty($surveyors)): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">Program Studi</th>
                            <th width="40%">Nama Surveyor</th>
                            <th width="30%">Kontak</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $currentProdi = '';
                        $rowNumber = 1;
                        foreach ($surveyors as $surveyor):
                            $prodi = $surveyor['program_studi'] ?? 'Unknown';
                            $showProdi = ($prodi !== $currentProdi);
                            if ($showProdi) $currentProdi = $prodi;
                        ?>
                            <tr>
                                <td><?= $showProdi ? $rowNumber : '' ?></td>
                                <td><?= $showProdi ? esc($currentProdi) : '' ?></td>
                                <td><?= esc($surveyor['name'] ?? 'Nama tidak tersedia') ?></td>
                                <td>
                                    <?php
                                    // Tampilkan email jika ada dan show_email = 1
                                    if (!empty($surveyor['show_email']) && !empty($surveyor['email'])) {
                                        echo esc($surveyor['email']) . '<br>';
                                    }

                                    // Tampilkan telepon jika ada dan show_phone = 1
                                    if (!empty($surveyor['show_phone'])) {
                                        if (!empty($surveyor['phone'])) {
                                            echo 'Telp: ' . esc($surveyor['phone']);
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php if ($showProdi) $rowNumber++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-muted"><em>Belum ada data surveyor yang ditampilkan.</em></p>
        <?php endif; ?>
    </div>

   <!-- Koordinator Section -->
<div class="mt-5">
    <p>
        <strong>Koordinator Surveyor Tahun <?= $currentYear ?></strong><br>
        Pada Tahun <?= $currentYear ?> Tracer Study dilakukan kepada Alumni POLBAN yang lulus pada Tahun <?= $currentYear-1 ?>.<br>
        Adapun nama-nama koordinator surveyor yang diangkat untuk membantu meningkatkan jumlah data yang masuk adalah sebagai berikut:
    </p>

    <?php if (!empty($coordinators)): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th width="25%">Jurusan</th>
                        <th width="40%">Nama Koordinator</th>
                        <th width="30%">Kontak</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $currentJurusan = '';
                    $rowNumber = 1;
                    foreach ($coordinators as $coordinator):
                        $jurusan = $coordinator['jurusan'] ?? 'Unknown';
                        $showJurusan = ($jurusan !== $currentJurusan);
                        if ($showJurusan) $currentJurusan = $jurusan;
                    ?>
                    <tr>
                        <td><?= $showJurusan ? $rowNumber : '' ?></td>
                        <td><?= $showJurusan ? esc($currentJurusan) : '' ?></td>
                        <td><?= esc($coordinator['name'] ?? 'Nama tidak tersedia') ?></td>
                        <td>
                            <?php
                            // Tampilkan email jika ada dan show_email = 1
                            if (!empty($coordinator['show_email']) && !empty($coordinator['email'])) {
                                echo esc($coordinator['email']) . '<br>';
                            }
                            
                            // Tampilkan telepon jika ada dan show_phone = 1
                            if (!empty($coordinator['show_phone'])) {
                                if (!empty($coordinator['phone'])) {
                                    echo 'Telp: ' . esc($coordinator['phone']);
                                }
                            }
                            ?>
                        </td>
                    </tr>
                    <?php if ($showJurusan) $rowNumber++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-muted"><em>Belum ada data koordinator surveyor yang ditampilkan.</em></p>
    <?php endif; ?>
</div>
</div>

<?= $this->endSection() ?>