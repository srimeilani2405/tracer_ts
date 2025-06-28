<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeModel extends Model
{
    protected $table            = 'organization_types';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['name', 'level', 'description', 'available_group'];

    // Tambahan opsional untuk keamanan dan kenyamanan
    protected $useTimestamps    = false; // ganti true jika tabel pakai created_at/updated_at
    protected $returnType       = 'array'; // default, tapi boleh juga pakai \App\Entities\Type jika pakai Entity
    protected $useSoftDeletes   = false;

    // Validasi opsional, jika ingin dipakai saat insert/update
    protected $validationRules = [
        'name'             => 'required|string|max_length[100]',
        'level'            => 'permit_empty|integer',
        'description'      => 'permit_empty|string|max_length[255]',
        'available_group'  => 'permit_empty|string|max_length[100]'
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Nama tipe organisasi wajib diisi.'
        ]
    ];
}
