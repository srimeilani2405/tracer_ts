<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class UserFieldModel extends Model
{
    protected $DBGroup = 'default'; // pastikan pakai koneksi default
    protected $table = 'users';     // tabel yang kita ambil kolomnya

    public function getUserFields()
    {
        // Ambil semua kolom dari tabel 'users'
        $db = Database::connect();
        $fields = $db->getFieldNames($this->table);

        return $fields;
    }
}
