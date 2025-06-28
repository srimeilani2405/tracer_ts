<?= $this->extend('layouts/tracer') ?>

<?= $this->section('content') ?>



<?php if (!empty($aboutPages)): ?>
    <?php foreach ($aboutPages as $page): ?>
        <div class="about-section mb-4">
            <h3><?= esc($page['title']) ?></h3>
            <div><?= $page['content'] ?></div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Konten tentang belum tersedia. Silakan buka admin panel untuk mengisi konten.</p>
<?php endif; ?>

<?= $this->endSection() ?>