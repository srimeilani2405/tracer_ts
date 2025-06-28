<?php
namespace App\Models;

use CodeIgniter\Model;

class TracerStudyModel extends Model
{
    protected $table = 'tracer_study_pages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['section', 'title', 'content'];
    protected $returnType = 'array';
    
    // Optional: Add method to get all sections
    public function getAllSections()
    {
        return $this->findAll();
    }
}