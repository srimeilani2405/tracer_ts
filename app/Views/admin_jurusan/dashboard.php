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
        gap: 15px; /* Jarak antar item diperbesar */
        margin-left: auto; /* Paksa ke kanan */
        background: #f5f5f5;
        padding: 8px 15px;
        border-radius: 20px;
    }
    .profile-section a {
        text-decoration: none;
        color: #2c3e50;
        font-weight: 500;
        transition: color 0.3s;
    }
    .profile-section a:hover {
        color: #3498db;
    }
    .profile-section .separator {
        color: #95a5a6;
    }
</style>
<body>
    <div class="content">
         <!-- Header section -->
         <div class="header-container">
            <!-- Judul default tersembunyi (jika ada) -->
            <div class="profile-section">
                <span class="user-role">Admin Jurusan</span>
                <span class="separator">|</span>
                <a href="<?= base_url('profile') ?>">Profil</a>
                <span class="separator">|</span>
                <a href="/logout">Keluar</a>
            </div>
        </div>

        <h2><?= esc($message['title']) ?></h2>
        <p><?= esc($message['greeting']) ?></p>
        <p><?= nl2br(esc($message['message_content'])) ?></p>
        <p><?= esc($message['closing']) ?></p>
        <p><?= esc($message['signature']) ?></p>
    </div>

    <div class="footer">
        <?= $message['footer'] ?>
    </div>
</body>

<?= $this->endSection() ?>
