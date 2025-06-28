<?php

namespace App\Models;

use CodeIgniter\Model;

class OrganizationModel extends Model
{
    protected $table = 'organizations';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'short_name', 'slug', 'description', 'tipe', 'urutan', 'parent_id', 'deleted_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    public function getByType($type = null)
    {
        $builder = $this->builder();
        if ($type) {
            $builder->where('tipe', $type);
        }
        $builder->where('deleted_at', null);
        return $builder->get()->getResultArray();
    }

    public function getHierarchy()
    {
        $builder = $this->builder();
        $builder->where('deleted_at', null);
        $builder->orderBy('parent_id', 'ASC');
        $organizations = $builder->get()->getResultArray();

        $data = [];

        foreach ($organizations as $org) {
            if (!isset($data[$org['id']])) {
                $data[$org['id']] = $org;
                $data[$org['id']]['children'] = [];
            }

            if ($org['parent_id'] == null) {
                continue;
            }

            if (!isset($data[$org['parent_id']])) {
                $data[$org['parent_id']] = [
                    'id' => $org['parent_id'],
                    'children' => []
                ];
            }

            $data[$org['parent_id']]['children'][] = &$data[$org['id']];
        }

        return array_values(array_filter($data, fn($org) => $org['parent_id'] == null));
    }

    public function getProgramStudiWithJurusan()
    {
        $builder = $this->builder('organizations p');
        $builder->select('p.id, p.name as program_studi, j.name as jurusan');
        $builder->join('organizations j', 'p.parent_id = j.id', 'left');
        $builder->where('p.tipe', 'Program Studi');
        $builder->where('p.deleted_at', null);
        $builder->where('j.deleted_at', null);
        return $builder->get()->getResultArray();
    }

    public function getJurusan()
    {
        $builder = $this->builder();
        $builder->where('tipe', 'Jurusan');
        $builder->where('deleted_at', null);
        return $builder->get()->getResultArray();
    }

    public function getProgramStudiByJurusan($jurusan_id)
    {
        $builder = $this->builder();
        $builder->where('tipe', 'Program Studi');
        $builder->where('parent_id', $jurusan_id);
        $builder->where('deleted_at', null);
        return $builder->get()->getResultArray();
    }
}
