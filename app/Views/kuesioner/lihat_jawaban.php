<?= $this->extend('layouts/tracer') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $kuesioner['title'] ?></h3>
        </div>
        <div class="card-body">
            <?php if (empty($answers)): ?>
                <div class="alert alert-info">Tidak ada jawaban yang tersimpan.</div>
            <?php else: ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 45%">Pertanyaan</th>
                            <th style="width: 50%">Jawaban</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($answers as $index => $answer): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($answer['question']) ?></td>
                                <td>
                                    <?= htmlspecialchars($answer['answer']) ?>
                                    <?php if (!empty($answer['other_answer'])): ?>
                                        <div class="text-muted mt-1">
                                            <small>Lainnya: "<?= htmlspecialchars($answer['other_answer']) ?>"</small>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            
            <div class="mt-3">
                <a href="<?= base_url('/alumni/dashboard') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>