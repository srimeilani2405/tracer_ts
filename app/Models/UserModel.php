<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'email',
        'username',
        'password',
        'role',
        'status',
        'nama',
        'jurusan',
        'program_studi',
        'no_hp',
        'nim',
        'angkatan',
        'ipk',
        'alamat1',
        'alamat2',
        'tahun_kelulusan',
        'jenis_kelamin',
        'kota',
        'provinsi',
        'kodepos',
        'created_at',
        'hak_supervisi',
        'kategori_supervisi',
        'supervisi_faculty',
        'supervisi_program_studi',
        'supervisi_academic_year',
        'supervisi_graduate_year'
    ];
    protected $useTimestamps = false;

    public function getUsersByRole($role = null)
    {
        if ($role) {
            return $this->where('role', $role)->findAll();
        }
        return $this->findAll();
    }

    public function getAllUsersWithOrganization()
    {
        return $this->select('users.*, 
                            jurusan.name as jurusan_name, 
                            prodi.name as program_studi_name')
            ->join('organizations jurusan', 'jurusan.id = users.jurusan', 'left')
            ->join('organizations prodi', 'prodi.id = users.program_studi', 'left')
            ->findAll();
    }

    public function getUserWithJoin($id)
    {
        return $this->select('users.*, 
                            jurusan.name as jurusan_name, 
                            prodi.name as program_studi_name')
            ->join('organizations jurusan', 'jurusan.id = users.jurusan', 'left')
            ->join('organizations prodi', 'prodi.id = users.program_studi', 'left')
            ->where('users.id', $id)
            ->first();
    }

    public function getSurveyors()
    {
        return $this->where('role', 'alumni')
            ->where('is_surveyor', 1)
            ->join('organizations', 'organizations.id = users.program_studi_id')
            ->select('users.*, organizations.name as program_studi')
            ->findAll();
    }

    public function getAlumniWithProgramStudi()
    {
        return $this->where('role', 'alumni')
            ->join('organizations', 'organizations.id = users.program_studi_id')
            ->select('users.*, organizations.name as program_studi')
            ->orderBy('program_studi')
            ->findAll();
    }

   // App/Models/UserModel.php
public function getProgramStudiOptions()
{
    return $this->distinct()
        ->select('program_studi')
        ->where('program_studi IS NOT NULL')
        ->where('program_studi !=', '')
        ->orderBy('program_studi', 'ASC')
        ->findAll();
}
}
