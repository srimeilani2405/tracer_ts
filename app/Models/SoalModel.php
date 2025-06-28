<?php

namespace App\Models;

use CodeIgniter\Model;

class SoalModel extends Model
{
    protected $table = 'soal_kuesioner';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_kuesioner', 'halaman', 'pertanyaan', 'deskripsi'];
}
