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
    .add-page-link {
        display: inline-block;
        margin-bottom: 20px;
        padding: 8px 16px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s;
    }
    .add-page-link:hover {
        background-color: #45a049;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
    }
    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
    }
    th {
        background-color: #f2f2f2;
    }
    .action-cell {
        white-space: nowrap;
    }
    .edit-button {
        display: inline-block;
        padding: 6px 12px;
        background-color: #2196F3;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        transition: all 0.3s;
        border: 1px solid transparent;
    }
    .edit-button:hover {
        background-color: #1976D2;
        transform: translateY(-1px);
    }
    .delete-button {
        padding: 6px 12px;
        background-color: #f44336;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s;
        margin-left: 8px;
    }
    .delete-button:hover {
        background-color: #d32f2f;
        transform: translateY(-1px);
    }
    .toggle-button {
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s;
    }
    .active-btn {
        background-color: #4CAF50;
        color: white;
    }
    .inactive-btn {
        background-color: #cccccc;
        color: #666666;
    }
</style>

<div class="main-content">
    <h1>Daftar Halaman</h1>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <a href="/pages/create" class="add-page-link">Tambah Halaman</a>

    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Isi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pages as $page): ?>
                <tr>
                    <td><?= esc($page['title']) ?></td>
                    <td><?= word_limiter(strip_tags($page['content']), 20) ?></td>
                    <td>
                        <button class="toggle-button <?= $page['is_active'] ? 'active-btn' : 'inactive-btn' ?>" 
                                data-id="<?= $page['id'] ?>">
                            <?= $page['is_active'] ? 'Aktif' : 'Nonaktif' ?>
                        </button>
                    </td>
                    <td class="action-cell">
                        <a href="/pages/edit/<?= $page['id'] ?>" class="edit-button">Edit</a>
                        <a href="#" class="delete-button" onclick="confirmDelete('pages', <?= $page['id'] ?>); return false;">Hapus</a>
                    </td>
                </tr>
            <?php endforeach ?>
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
document.querySelectorAll('.toggle-button').forEach(button => {
    button.addEventListener('click', function() {
        const pageId = this.dataset.id;
        const isActive = this.classList.contains('active-btn');

        fetch(`/pages/toggle/${pageId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?= csrf_token() ?>',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ is_active: !isActive })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                this.classList.toggle('active-btn');
                this.classList.toggle('inactive-btn');
                this.textContent = data.is_active ? 'Aktif' : 'Nonaktif';
            }
        });
    });
});

// Script konfirmasi hapus universal
function confirmDelete(type, id) {
    let deleteUrl = "";

    if (type === 'pages') {
        deleteUrl = "<?= base_url('/pages/delete/') ?>" + id;
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
