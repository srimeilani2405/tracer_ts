<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>

<div class="content">
    <h2>Tipe Organisasi</h2>
    <a href="<?= base_url('/organisasi/types/add') ?>" class="btn btn-warning mb-3">+ Tambah Tipe</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Tipe</th>
                <th>Level</th>
                <th>Deskripsi</th>
                <th>Grup Tersedia</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($types)): ?>
                <?php $no = 1; ?>
                <?php foreach ($types as $type): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= esc($type['name']); ?></td>
                        <td><?= esc($type['level']); ?></td>
                        <td><?= esc($type['description'] ?? '-'); ?></td>
                        <td>
                            <?= !empty($type['available_group'])
                                ? '<a href="/' . esc($type['available_group']) . '">' . esc($type['available_group']) . '</a>'
                                : '-'; ?>
                        </td>
                        <td>
                            <a href="<?= base_url('/organisasi/types/edit/' . $type['id']) ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete('organisasi_type', <?= $type['id'] ?>); return false;">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Data tidak tersedia</td>
                </tr>
            <?php endif; ?>
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
    // Script konfirmasi hapus khusus untuk tipe organisasi
    function confirmDelete(type, id) {
        let deleteUrl = "";

        if (type === 'organisasi_type') {
            deleteUrl = "<?= base_url('/organisasi/types/delete/') ?>" + id;
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
