<?php

namespace App\Models;

use CodeIgniter\Model;

class HalamanModel extends Model
{
    protected $table = 'halaman_kuesioner';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_kuesioner', 'halaman'];
}
