<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>

<div class="content">
    <h2>Alumni</h2>
    <div class="d-flex justify-content-between mb-3">
        <div>
            <a href="<?= base_url('alumni/add') ?>" class="btn btn-primary">+ Tambah Alumni</a>
            <a href="<?= base_url('alumni/import') ?>" class="btn btn-warning">+ Import Alumni</a>
        </div>
    </div>

    <ul class="nav nav-tabs mb-3">
        <li class="nav-item"><a class="nav-link" href="<?= base_url('/users') ?>">Semua Group</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('/site_admin') ?>">Site Admin</a></li>
        <li class="nav-item"><a class="nav-link active" href="<?= base_url('/alumni') ?>">Alumni</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('/admin_jurusan') ?>">Admin Jurusan</a></li>
    </ul>

    <!-- Form Filter -->
    <form method="get" action="<?= base_url('alumni') ?>" class="mb-3">
        <div class="row g-2">
            <div class="col-md-2">
                <input type="text" name="nim" class="form-control" placeholder="NIM" value="<?= esc($filter['nim'] ?? '') ?>">
            </div>
            <div class="col-md-2">
                <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?= esc($filter['nama'] ?? '') ?>">
            </div>
            <div class="col-md-2">
                <select name="jurusan" class="form-select">
                    <option value="">Jurusan</option>
                    <?php foreach ($jurusanOptions as $jurusan): ?>
                        <option value="<?= esc($jurusan) ?>" <?= ($filter['jurusan'] ?? '') === $jurusan ? 'selected' : '' ?>><?= esc($jurusan) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select name="program_studi" class="form-select">
                    <option value="">Program Studi</option>
                    <?php foreach ($prodiOptions as $prodi): ?>
                        <option value="<?= esc($prodi) ?>" <?= ($filter['program_studi'] ?? '') === $prodi ? 'selected' : '' ?>><?= esc($prodi) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <input type="text" name="angkatan" class="form-control" placeholder="Angkatan" value="<?= esc($filter['angkatan'] ?? '') ?>">
            </div>
        </div>
        <div class="mt-2">
            <button type="submit" class="btn btn-info">🔍 Saring</button>
            <a href="<?= base_url('alumni') ?>" class="btn btn-secondary">❌ Clear</a>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Username</th>
                <th>Email</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Program Studi</th>
                <th>Angkatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alumni as $data): ?>
                <tr>
                    <td><?= esc($data['nim']) ?></td>
                    <td><?= esc($data['username']) ?></td>
                    <td><?= esc($data['email']) ?></td>
                    <td><?= esc($data['nama']) ?></td>
                    <td><?= esc($data['jurusan'] ?? '-') ?></td>
                    <td><?= esc($data['program_studi'] ?? '-') ?></td>
                    <td><?= esc($data['angkatan']) ?></td>
                    <td>
                        <a href="<?= base_url('alumni/edit/' . $data['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
<a href="#" 
   class="btn btn-sm btn-danger" 
   onclick="confirmDeleteAlumni(<?= $data['id'] ?>); return false;">
   Hapus
</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Modal Konfirmasi Hapus Alumni -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus Alumni</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus alumni ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="#" id="deleteButton" class="btn btn-danger">Hapus</a>
      </div>
    </div>
  </div>
</div>
</div>
<script>
function confirmDeleteAlumni(id) {
    let deleteUrl = "<?= base_url('alumni/delete/') ?>" + id;
    document.getElementById('deleteButton').setAttribute('href', deleteUrl);
    var myModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    myModal.show();
}
</script>

<?= $this->include('templates/footer') ?>