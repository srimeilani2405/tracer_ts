<?php

namespace App\Models;

use CodeIgniter\Model;

class SiteAdminModel extends Model
{
    protected $table = 'users'; // Tetap mengambil dari tabel users
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username', 'email', 'nama', 'role' // Tambahkan role
    ];

    // Ambil semua site admin
    public function getSiteAdmin()
    {
        return $this->where('role', 'site_admin')->findAll();
    }
}
