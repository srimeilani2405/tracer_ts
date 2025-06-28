<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>

<div class="content">
    <h2 class="mb-3">Satuan Organisasi</h2>
    <a href="<?= base_url('/organisasi/create') ?>" class="btn btn-primary mb-3">+ Tambah Satuan Organisasi</a>

    <ul class="nav nav-tabs mb-3">
        <li class="nav-item"><a class="nav-link active" href="<?= base_url('/organisasi/units') ?>">Seluruh Hirarki</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('/jurusan') ?>">Jurusan</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('/program_studi') ?>">Program Studi</a></li>
    </ul>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nama Satuan Organisasi</th>
                        <th>Tipe</th>
                        <th>Singkatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($organizations as $org): ?>
                        <tr class="parent-row" data-id="<?= $org['id'] ?>">
                            <td>
                                <span class="toggle-icon me-2">❯</span>
                                <?= esc($org['name']) ?>
                            </td>
                            <td><?= esc($org['tipe']) ?></td>
                            <td><?= esc($org['short_name'] ?? '-') ?></td>
                            <td>
                                <a href="<?= base_url('/organisasi/units/view/' . $org['id']) ?>" class="btn btn-sm btn-info">Tinjau</a>
                                <a href="<?= base_url('/organisasi/edit/' . $org['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                <!-- Tombol Hapus untuk Parent -->
                                <a href="#" class="btn btn-sm btn-danger" onclick="confirmDelete('organisasi', <?= $org['id'] ?>); return false;">Hapus</a>
                            </td>
                        </tr>

                        <?php if (!empty($org['children'])): ?>
                            <?php foreach ($org['children'] as $child): ?>
                                <tr class="child-row child-of-<?= $org['id'] ?>" style="display: none;">
                                    <td class="ps-5">
                                        <?= esc($child['name']) ?>
                                    </td>
                                    <td><?= esc($child['tipe']) ?></td>
                                    <td><?= esc($child['short_name'] ?? '-') ?></td>
                                    <td>
                                        <a href="<?= base_url('/organisasi/units/view/' . $child['id']) ?>" class="btn btn-sm btn-info">Tinjau</a>
                                        <a href="<?= base_url('/organisasi/edit/' . $child['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <!-- Tombol Hapus untuk Child -->
                                        <a href="#" class="btn btn-sm btn-danger" onclick="confirmDelete('organisasi', <?= $child['id'] ?>); return false;">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
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

        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const parentRows = document.querySelectorAll('.parent-row');

        parentRows.forEach(function(row) {
            const toggleIcon = row.querySelector('.toggle-icon');

            if (toggleIcon) {
                row.addEventListener('click', function(e) {
                    // Skip if clicked on a button or link
                    if (e.target.tagName === 'A' || e.target.tagName === 'BUTTON') {
                        return;
                    }

                    const parentId = row.getAttribute('data-id');
                    const childRows = document.querySelectorAll('.child-of-' + parentId);

                    childRows.forEach(function(childRow) {
                        if (childRow.style.display === "none") {
                            childRow.style.display = "table-row";
                            toggleIcon.textContent = "▼";
                        } else {
                            childRow.style.display = "none";
                            toggleIcon.textContent = "❯";
                        }
                    });
                });
            }
        });

        // Script konfirmasi hapus universal
        window.confirmDelete = function(type, id) {
            let deleteUrl = "";

            switch (type) {
                case 'organisasi':
                    deleteUrl = "<?= base_url('organisasi/delete/') ?>" + id;
                    break;
                default:
                    console.error("Unknown delete type:", type);
                    return;
            }

            document.getElementById('deleteButton').setAttribute('href', deleteUrl);
            var myModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            myModal.show();
        }
    });
</script>


<?= $this->include('templates/footer') ?>