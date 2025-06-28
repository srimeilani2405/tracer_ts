<?php
namespace App\Models;

use CodeIgniter\Model;

class DataIsianModel extends Model
{
    protected $table = 'data_isian_kuesioner'; // Sesuaikan dengan nama tabel di database
    protected $primaryKey = 'id'; // Sesuaikan dengan primary key tabel
    protected $allowedFields = ['kuesioner_id', 'nim', 'nama', 'program_studi', 'angkatan', 'jawaban']; // Sesuaikan dengan kolom yang ada di tabel
}