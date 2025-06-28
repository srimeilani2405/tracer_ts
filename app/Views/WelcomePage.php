<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>

<div class="container-fluid p-4">
    <h3 class="mb-4">Sunting Welcome</h3>
    <div class="card p-4 shadow-sm border-0 mt-3">
        <form action="/welcome/save" method="post">
            <div class="mb-3">
                <label for="welcomeMessage" class="form-label fw-semibold">Welcome Message</label>
                <textarea id="welcomeMessage" name="welcomeMessage" class="form-control" rows="6"><?= esc($welcomeMessage) ?></textarea>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-danger">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    CKEDITOR.replace('welcomeMessage');
</script>

<?= $this->include('templates/footer') ?>
