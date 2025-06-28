<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTinjauKuesioner extends Model
{
    protected $table = 'soal_kuesioner';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_kuesioner', 'halaman', 'pertanyaan', 'tipe'];

    // Ambil semua halaman unik berdasarkan ID Kuesioner
    public function getHalamanKuesioner($id_kuesioner)
    {
        return $this->db->table($this->table)
            ->select('DISTINCT(halaman)')
            ->where('id_kuesioner', $id_kuesioner)
            ->orderBy('halaman', 'ASC')
            ->get()->getResultArray();
    }

    // Ambil pertanyaan berdasarkan ID Kuesioner dan Halaman tertentu
    public function getSoalByHalaman($id_kuesioner, $halaman)
    {
        return $this->db->table($this->table)
            ->where('id_kuesioner', $id_kuesioner)
            ->where('halaman', $halaman)
            ->get()->getResultArray();
    }
}
