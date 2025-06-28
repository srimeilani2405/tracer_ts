<?= $this->extend('layouts/tracer') ?>
<?= $this->section('content') ?>

<style>
    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .profile-section {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-left: auto;
        background: #f5f5f5;
        padding: 8px 15px;
        border-radius: 20px;
    }

    .info-box {
        background-color: #fff;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .btn {
        display: inline-block;
        padding: 8px 16px;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-weight: bold;
        margin-top: 10px;
    }
    
    .btn-primary { background-color: #3498db; }
    .btn-continue { background-color: #f39c12; }
    .btn-view { background-color: #27ae60; }

    .btn-primary:hover { background-color: #2980b9; }
    .btn-continue:hover { background-color: #e67e22; }
    .btn-view:hover { background-color: #2ecc71; }
</style>

<div class="content">
    <div class="header-container">
        <div class="profile-section">
            <span class="user-role">Alumni</span>
            <span class="separator">|</span>
            <a href="<?= base_url('profile') ?>">Profil</a>
            <span class="separator">|</span>
            <a href="<?= base_url('logout') ?>">Keluar</a>
        </div>
    </div>

 <?php if (!empty($kuesionerList)): ?>
    <?php foreach ($kuesionerList as $kuesionerData): ?>
        <div class="info-box">
            <?php if (!empty($kuesionerData['isEligible'])): ?>
                <?php if (!empty($kuesionerData['status']) && $kuesionerData['status'] === 'submitted'): ?>
                    <h3>Kuesioner Tracer Study Selesai</h3>
                    <p>Alumni: <strong><?= esc($loggedInName ?? 'Alumni') ?></strong></p>
                    <p>Tahun lulus: <?= esc($tahunKelulusan ?? '-') ?></p>
                    <p>Terima kasih telah menyelesaikan kuesioner tracer study.</p>
                    <a href="<?= site_url('kuesioner/lihat_jawaban/' . $kuesionerData['id']) ?>" class="btn btn-view">
                        Lihat Jawaban
                    </a>
                <?php elseif (!empty($kuesionerData['status']) && $kuesionerData['status'] === 'draft'): ?>
                    <h3>Lanjutkan Pengisian Kuesioner</h3>
                    <p>Alumni: <strong><?= esc($loggedInName ?? 'Alumni') ?></strong></p>
                    <p>Tahun lulus: <?= esc($tahunKelulusan ?? '-') ?></p>
                    <p>Anda memiliki pengisian kuesioner yang belum selesai.</p>
                    <a href="<?= site_url('kuesioner/isi/' . $kuesionerData['id'] . '?page=' . ($kuesionerData['last_page'] ?? 1)) ?>" class="btn btn-continue">
                        Lanjutkan Pengisian
                    </a>
                <?php else: ?>
                    <h3>Kuesioner Tracer Study Tersedia</h3>
                    <p>Alumni: <strong><?= esc($loggedInName ?? 'Alumni') ?></strong></p>
                    <p>Tahun lulus: <?= esc($tahunKelulusan ?? '-') ?></p>
                    <p>Silakan isi kuesioner untuk alumni lulusan tahun <?= esc($tahunKelulusan ?? '-') ?></p>
                    <a href="<?= site_url('kuesioner/isi/' . $kuesionerData['id']) ?>" class="btn btn-primary">
                        Isi Kuesioner
                    </a>
                <?php endif; ?>
            <?php else: ?>
                <h3>Kuesioner Tidak Tersedia</h3>
                <p>Alumni: <strong><?= esc($loggedInName ?? 'Alumni') ?></strong></p>
                <p>Tahun lulus: <?= esc($tahunKelulusan ?? '-') ?></p>
                <p><?= nl2br(esc($kuesionerData['message'] ?? 'Anda tidak memenuhi syarat untuk mengisi kuesioner ini.')) ?></p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="info-box">
        <h3>Tidak Ada Kuesioner Aktif</h3>
        <p>Alumni: <strong><?= esc($loggedInName ?? 'Alumni') ?></strong></p>
        <p>Saat ini tidak ada kuesioner aktif yang tersedia.</p>
    </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>