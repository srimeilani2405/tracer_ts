<?= $this->extend('layouts/tracer') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="card shadow">
        <div class="card-body text-center py-5">
            <i class="fas fa-check-circle text-success fa-5x mb-4"></i>
            <h2 class="mb-3">Terima Kasih!</h2>
            <p class="lead">Kuesioner Anda telah berhasil dikirim.</p>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <a href="<?= base_url('/alumni/dashboard') ?>" class="btn btn-primary mt-3">
                <i class="fas fa-home"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>