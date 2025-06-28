<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Pengguna</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">
        <div class="card shadow p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0"><?= esc($user->nama ?? 'Site') ?></h3>
                <div>
                    <a href="<?= $_SERVER['HTTP_REFERER'] ?? base_url('/users') ?>" class="btn btn-warning btn-sm me-2">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <a href="<?= base_url('/profile/edit/' . $user->id) ?>" class="btn btn-primary btn-sm">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 text-center">
                    <img src="https://www.gravatar.com/avatar/<?= md5(strtolower(trim($user->email ?? ''))) ?>?s=200"
                        class="img-thumbnail rounded mb-3" alt="User Avatar" style="width: 100%; max-width: 200px;">

                    <?php if (!empty($user->status) && $user->status === 'aktif'): ?>
                        <span class="badge bg-success px-3 py-2">
                            <i class="bi bi-check-circle me-1"></i> Aktif
                        </span>
                    <?php else: ?>
                        <span class="badge bg-secondary px-3 py-2">
                            <i class="bi bi-x-circle me-1"></i> Tidak Aktif
                        </span>
                    <?php endif; ?>
                </div>

                <div class="col-md-9">
                    <h5 class="mb-3">Account</h5>
                    <table class="table table-borderless mb-4">
                        <tr>
                            <th style="width: 150px;">
                                <i class="bi bi-envelope-fill me-2 text-warning"></i> Email
                            </th>
                            <td>: <?= esc($user->email ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-person-fill me-2 text-warning"></i> Username
                            </th>
                            <td>: <?= esc($user->username ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-people-fill me-2 text-warning"></i> Grup
                            </th>
                            <td>: <?= esc(ucwords($user->role ?? 'Admin')) ?></td>
                        </tr>
                    </table>

                    <h5 class="mb-3">Detail Pengguna</h5>
                    <table class="table table-borderless">
                        <tr>
                            <th>
                                <i class="bi bi-person-fill-check me-2 text-warning"></i> Nama
                            </th>
                            <td>: <?= esc($user->nama ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-calendar-event me-2 text-danger"></i> Tergabung
                            </th>
                            <td>: <?= isset($user->created_at) ? date('F d, Y', strtotime($user->created_at)) : '-' ?></td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-clock-history me-2 text-primary"></i> Terakhir Berkunjung
                            </th>
                            <td>: <?= isset($user->last_login) ? date('F d, Y', strtotime($user->last_login)) : '-' ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>