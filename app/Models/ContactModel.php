<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
    protected $table      = 'tracer_study_contacts';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['name', 'email', 'phone', 'position', 'qualification', 'contact_type', 'sort_order'];
    protected $validationRules = [
        'name'          => 'required|min_length[3]|max_length[255]',
        'email'         => 'required|valid_email',
        'phone'         => 'required|min_length[10]',
        'position'      => 'required',
        'contact_type'  => 'required',
        'sort_order'    => 'required|integer',
    ];

    public function getByContactType($type)
    {
        return $this->where('contact_type', $type)->findAll();
    }

    public function getAlumniSurveyors()
    {
        return $this->db->table('users')
            ->where('role', 'alumni')
            ->get()
            ->getResultArray();
    }
}
