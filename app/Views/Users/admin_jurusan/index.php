<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>

<div class="content">
    <h2>Admin Jurusan</h2>
    <div class="d-flex justify-content-between mb-3">
        <div>
            <a href="<?= base_url('admin_jurusan/add') ?>" class="btn btn-primary">+ Tambah Admin Jurusan</a>
            <a href="<?= base_url('admin_jurusan/import') ?>" class="btn btn-warning">+ Import Admin Jurusan</a>
        </div>
    </div>

    <ul class="nav nav-tabs mb-3">
        <li class="nav-item"><a class="nav-link" href="<?= base_url('/users') ?>">Semua Group</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('/site_admin') ?>">Site Admin</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('/alumni') ?>">Alumni</a></li>
        <li class="nav-item"><a class="nav-link active" href="<?= base_url('/admin_jurusan') ?>">Admin Jurusan</a></li>
    </ul>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Username</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($admin_jurusan as $admin): ?>
                <tr>
                    <td><?= esc($admin['username']) ?></td>
                    <td><?= esc($admin['nama']) ?></td>
                    <td><?= esc($admin['email']) ?></td>
                    <td><?= esc($admin['jurusan']) ?></td>
                    <td>
                        <a href="<?= base_url('admin_jurusan/edit/' . $admin['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="#"
                            class="btn btn-sm btn-danger"
                            onclick="confirmDeleteAdminJurusan(<?= $admin['id'] ?>); return false;">
                            Hapus
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Modal Konfirmasi Hapus Admin Jurusan -->
<div class="modal fade" id="confirmDeleteAdminJurusanModal" tabindex="-1" aria-labelledby="confirmDeleteAdminJurusanModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteAdminJurusanModalLabel">Konfirmasi Hapus Admin Jurusan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus admin jurusan ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="#" id="deleteAdminJurusanButton" class="btn btn-danger">Hapus</a>
      </div>
    </div>
  </div>
</div>
</div>
<script>
function confirmDeleteAdminJurusan(id) {
    let deleteUrl = "<?= base_url('admin_jurusan/delete/') ?>" + id;
    document.getElementById('deleteAdminJurusanButton').setAttribute('href', deleteUrl);
    var myModal = new bootstrap.Modal(document.getElementById('confirmDeleteAdminJurusanModal'));
    myModal.show();
}
</script>

<?= $this->include('templates/footer') ?>