<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>

<div class="content">
    <h2>Pengguna</h2>
    <div class="d-flex justify-content-between mb-3">
        <div>
            <a href="<?= base_url('users/create') ?>" class="btn btn-primary">+ Tambah Pengguna</a>
        </div>
    </div>

    <ul class="nav nav-tabs mb-3">
        <li class="nav-item"><a class="nav-link active" href="<?= base_url('/users') ?>">Semua Group</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('/site_admin') ?>">Site Admin</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('/alumni') ?>">Alumni</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('/admin_jurusan') ?>">Admin Jurusan</a></li>
    </ul>

    <form method="get" action="<?= base_url('users') ?>" class="mb-3">
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <label for="keyword" class="col-form-label">Kata Kunci:</label>
            </div>
            <div class="col-auto">
                <input type="text" id="keyword" name="keyword" class="form-control" value="<?= esc($filter['keyword'] ?? '') ?>" placeholder="Cari pengguna...">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-info">🔍 Saring</button>
                <a href="<?= base_url('users') ?>" class="btn btn-secondary">❌ Clear</a>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Username</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Grup</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= esc($user['username']) ?></td>
                    <td><?= esc($user['nama']) ?></td>
                    <td><?= esc($user['email']) ?></td>
                    <td><?= esc($user['role']) ?></td>
                    <td>
                        <a href="<?= base_url('users/edit/' . $user['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                        <button type="button" class="btn btn-danger" onclick="confirmDelete(<?= $user['id']; ?>)">Hapus</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Hapus Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus pengguna ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="#" id="deleteLink" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    function confirmDelete(id) {
        const deleteUrl = "/users/delete/" + id;
        document.getElementById('deleteLink').setAttribute('href', deleteUrl);
        var myModal = new bootstrap.Modal(document.getElementById('confirmModal'), {});
        myModal.show();
    }
</script>

<?= $this->include('templates/footer') ?>