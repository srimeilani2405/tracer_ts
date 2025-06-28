<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>

<div class="content">
    <h2 class="mb-3">Daftar Program Studi</h2>
    <a href="<?= base_url('/program_studi/create') ?>" class="btn btn-warning mb-3">+ Tambah Program Studi</a>

    <!-- Tab Navigation -->
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item"><a class="nav-link" href="<?= base_url('/organisasi/units') ?>">Seluruh Hirarki</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('/jurusan') ?>">Jurusan</a></li>
        <li class="nav-item"><a class="nav-link active" href="<?= base_url('/program_studi') ?>">Program Studi</a></li>
    </ul>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Nama Program Studi</th>
                <th>Jurusan (Satuan Induk)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($program_studi as $ps) : ?>
                <tr>
                    <td><?= esc($ps['program_studi']) ?></td>
                    <td><?= !empty($ps['jurusan']) ? esc($ps['jurusan']) : 'Tidak Diketahui' ?></td>
                    <td>
                        <a href="<?= base_url('program_studi/tinjau/' . $ps['id']) ?>" class="btn btn-info btn-sm">Tinjau</a>
                        <a href="<?= base_url('program_studi/edit/' . $ps['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete('program_studi', <?= $ps['id'] ?>); return false;">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Konfirmasi Hapus Universal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus data ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="#" id="deleteButton" class="btn btn-danger">Hapus</a>
      </div>
    </div>
  </div>
</div>

<script>
    // Script konfirmasi hapus khusus untuk program_studi
    function confirmDelete(type, id) {
        let deleteUrl = "";

        if (type === 'program_studi') {
            deleteUrl = "<?= base_url('/program_studi/delete/') ?>" + id;
        } else {
            console.error("Tipe penghapusan tidak dikenali:", type);
            return;
        }

        document.getElementById('deleteButton').setAttribute('href', deleteUrl);
        var myModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        myModal.show();
    }
</script>

<?= $this->include('templates/footer') ?>
