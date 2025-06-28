<?php

namespace App\Models;

use CodeIgniter\Model;

class PageModel extends Model
{
    protected $table      = 'tracer_study_pages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['section', 'title', 'content', 'is_active'];

    public function getAllPages()
    {
        return $this->findAll();
    }

    public function getActivePages()
    {
        return $this->where('is_active', 1)->findAll();
    }

    
public function getAboutPages()
{
    return $this->where('section', 'about')
               ->where('is_active', 1) // Tambahkan ini
               ->findAll();
}

    public function getContactPage()
    {
        return $this->where('section', 'contact')->first();
    }
}