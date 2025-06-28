<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminJurusanModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nim', 'username', 'nama', 'email', 'jurusan', 'password', 'role'];
    public function getAdminJurusan()
    {
        return $this->where('role', 'admin_jurusan')->findAll();
    }
}
