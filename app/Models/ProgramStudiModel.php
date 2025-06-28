<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramStudiModel extends Model
{
    protected $table = 'program_studi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'jurusan_id'];

    public function getProgramStudiWithJurusan()
    {
        return $this->db->table('program_studi')
            ->select('program_studi.*, jurusan.id as jurusan_id')
            ->join('jurusan', 'jurusan.id = program_studi.jurusan_id', 'left')
            ->get()->getResultArray();
    }
}
