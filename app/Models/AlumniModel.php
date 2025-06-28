<?php

namespace App\Models;

use CodeIgniter\Model;

class AlumniModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nim', 'username', 'email', 'password', 'nama',
        'jurusan', 'program_studi', 'angkatan', 'role',
        'ipk', 'alamat1', 'alamat2', 'status', 'tahun_kelulusan',
        'jenis_kelamin', 'no_hp', 'kota', 'provinsi', 'kodepos'
    ];

    public function getAlumni()
    {
        return $this->where('role', 'alumni')->findAll();
    }
}