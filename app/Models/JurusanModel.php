<?php

namespace App\Models;

use CodeIgniter\Model;

class JurusanModel extends Model
{
    protected $table = 'jurusan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'organization_id'];

    public function getAllJurusan()
    {
        $query = $this->db->query("SELECT * FROM jurusan");
        return $query->getResultArray();
    }

    public function getProgramStudi()
    {
        return $this->db->table('organizations p')
            ->select('p.id, p.name AS program_studi, j.name AS jurusan, p.created_at')
            ->join('organizations j', 'p.parent_id = j.id', 'left')
            ->where('p.tipe', 'program_studi')
            ->get()
            ->getResultArray();
    }
}
