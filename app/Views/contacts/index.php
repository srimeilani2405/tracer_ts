<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    .main-content {
        margin-left: 250px;
        padding: 20px;
        background-color: #f9f9f9;
        min-height: 100vh;
    }

    h1 {
        margin-bottom: 20px;
    }

    .alert {
        padding: 10px;
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    .add-contact-link {
        display: inline-block;
        margin-bottom: 20px;
        padding: 8px 16px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        border-radius: 4px;
    }

    .add-contact-link:hover {
        background-color: #45a049;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        vertical-align: top;
    }

    th {
        background-color: #f2f2f2;
    }

    .no-data {
        text-align: center;
        padding: 20px;
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeeba;
        border-radius: 4px;
    }
</style>

<div class="main-content">
    <h1>Daftar Kontak</h1>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>

    <a href="/contacts/create" class="add-contact-link">Tambah Kontak</a>

    <?php if (!empty($contacts)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Posisi</th>
                    <th>Kualifikasi</th>
                    <th>Tipe Kontak</th>
                    <th>Urutan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><?= esc($contact['name']) ?></td>
                        <td><?= esc($contact['position']) ?></td>
                        <td><?= esc($contact['qualification']) ?: '-' ?></td>
                        <td><?= esc($contact['contact_type']) ?></td>
                        <td><?= esc($contact['sort_order']) ?></td>
                        <td>
                            <a href="/contacts/edit/<?= $contact['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete('contacts', <?= $contact['id'] ?>); return false;">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php else : ?>
        <div class="no-data">
            Tidak ada data kontak yang tersedia.
        </div>
    <?php endif; ?>
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
    function confirmDelete(type, id) {
        let deleteUrl = "";

        if (type === 'contacts') {
            deleteUrl = "<?= base_url('/contacts/delete/') ?>" + id;
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
