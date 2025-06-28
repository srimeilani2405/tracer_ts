<?php

namespace App\Models;

use CodeIgniter\Model;

class KuesionerSectionModel extends Model
{
    protected $table = 'kuesioner_kuesioner_section';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title', 
        'deskripsi', 
        'kuesioner_id', 
        'page_id', 
        'section_options', 
        'fields', 
        'conditional_logic',
        'ordering_count',
        'created_on',
        'updated_on'
    ];
    
    protected $useTimestamps = false;
    protected $createdField = 'created_on';
    protected $updatedField = 'updated_on';
    
    protected $validationRules = [
        'title' => 'required|min_length[3]|max_length[255]',
        'kuesioner_id' => 'required|numeric',
        'page_id' => 'required|numeric',
        'ordering_count' => 'permit_empty|numeric'
    ];
    
    protected $validationMessages = [
        'title' => [
            'required' => 'Judul section harus diisi',
            'min_length' => 'Judul section minimal 3 karakter',
            'max_length' => 'Judul section maksimal 255 karakter'
        ],
        'kuesioner_id' => [
            'required' => 'ID Kuesioner harus diisi',
            'numeric' => 'ID Kuesioner harus berupa angka'
        ],
        'page_id' => [
            'required' => 'ID Halaman harus diisi',
            'numeric' => 'ID Halaman harus berupa angka'
        ],
        'ordering_count' => [
            'numeric' => 'Urutan harus berupa angka'
        ]
    ];

    /**
     * Get sections by page with question count
     */
   public function getSectionsWithQuestionCount($pageId)
{
    return $this->select('kuesioner_kuesioner_section.*, COUNT(kuesioner_fields.id) as question_count')
        ->join('kuesioner_fields', 'kuesioner_fields.section_id = kuesioner_kuesioner_section.id', 'left')
        ->where('page_id', $pageId)
        ->groupBy('kuesioner_kuesioner_section.id')
        ->orderBy('ordering_count', 'ASC')
        ->findAll();
}

    /**
     * Get next ordering count for new section
     */
    public function getNextOrderingCount($pageId)
    {
        $lastSection = $this->where('page_id', $pageId)
                           ->orderBy('ordering_count', 'DESC')
                           ->first();

        return $lastSection ? $lastSection['ordering_count'] + 1 : 1;
    }

    /**
     * Update section ordering
     */
    public function updateSectionOrdering($pageId)
    {
        $sections = $this->where('page_id', $pageId)
                        ->orderBy('ordering_count', 'ASC')
                        ->findAll();

        $order = 1;
        foreach ($sections as $section) {
            $this->update($section['id'], ['ordering_count' => $order]);
            $order++;
        }
    }

    /**
     * Handle JSON fields before insert/update
     */
    protected function handleJsonFields(array $data)
    {
        if (isset($data['section_options'])) {
            $data['section_options'] = is_array($data['section_options']) 
                ? json_encode($data['section_options'], JSON_UNESCAPED_UNICODE) 
                : $data['section_options'];
        }

        if (isset($data['fields'])) {
            $data['fields'] = is_array($data['fields']) 
                ? json_encode($data['fields'], JSON_UNESCAPED_UNICODE) 
                : $data['fields'];
        }

        if (isset($data['conditional_logic'])) {
            $data['conditional_logic'] = is_array($data['conditional_logic']) 
                ? json_encode($data['conditional_logic'], JSON_UNESCAPED_UNICODE) 
                : $data['conditional_logic'];
        }

        return $data;
    }

    /**
     * Override insert to handle JSON fields
     */
    public function insert($data = null, bool $returnID = true)
    {
        $data = $this->handleJsonFields($data);
        return parent::insert($data, $returnID);
    }

    /**
     * Override update to handle JSON fields
     */
    public function update($id = null, $data = null): bool
    {
        $data = $this->handleJsonFields($data);
        return parent::update($id, $data);
    }
}