<?php
namespace App\Models;

use CodeIgniter\Model;

class KuesionerModel extends Model
{
    protected $table = 'kuesioner_kuesioner';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'deskripsi', 'conditional_logic', 'entries', 'active'];
    protected $useTimestamps = false; // Aktifkan jika ingin mencatat created_at dan updated_at
    protected $validationRules = [
        'title' => 'required|min_length[3]|max_length[255]',
        'deskripsi' => 'permit_empty|max_length[500]'
    ];

    
}