<?php

namespace App\Models;

use CodeIgniter\Model;

class KuesionerPageModel extends Model
{
    protected $table = 'kuesioner_page';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'kuesioner_id', 
        'title', 
        'deskripsi', 
        'conditional_logic', 
        'ordering_count', 
        'created_on', 
        'updated_on'
    ];
    protected $useTimestamps = false;
    
    protected $validationRules = [
        'kuesioner_id' => 'required|numeric',
        'title' => 'required|min_length[3]|max_length[255]',
        'ordering_count' => 'permit_empty|numeric'
    ];
    
    protected $validationMessages = [
        'kuesioner_id' => [
            'required' => 'ID Kuesioner harus diisi',
            'numeric' => 'ID Kuesioner harus berupa angka'
        ],
        'title' => [
            'required' => 'Judul halaman harus diisi',
            'min_length' => 'Judul halaman minimal 3 karakter',
            'max_length' => 'Judul halaman maksimal 255 karakter'
        ],
        'ordering_count' => [
            'numeric' => 'Urutan harus berupa angka'
        ]
    ];

    /**
     * Get pages with section count for a questionnaire
     */
    public function getPagesWithSectionCount($kuesionerId)
    {
        return $this->select('kuesioner_page.*, COUNT(kuesioner_section.id) as section_count')
                   ->join('kuesioner_section', 'kuesioner_section.page_id = kuesioner_page.id', 'left')
                   ->where('kuesioner_page.kuesioner_id', $kuesionerId)
                   ->groupBy('kuesioner_page.id')
                   ->orderBy('kuesioner_page.ordering_count', 'ASC')
                   ->findAll();
    }

    /**
     * Get single page with sections
     */
    public function getPageWithSections($pageId)
    {
        $page = $this->find($pageId);
        if (!$page) {
            return null;
        }

        $sectionModel = new KuesionerSectionModel();
        $page['sections'] = $sectionModel->where('page_id', $pageId)
                                        ->orderBy('ordering_count', 'ASC')
                                        ->findAll();

        return $page;
    }

    /**
     * Get next ordering count for new page
     */
    public function getNextOrderingCount($kuesionerId)
    {
        $lastPage = $this->where('kuesioner_id', $kuesionerId)
                        ->orderBy('ordering_count', 'DESC')
                        ->first();

        return $lastPage ? $lastPage['ordering_count'] + 1 : 1;
    }

    /**
     * Update page ordering
     */
    public function updatePageOrdering($kuesionerId)
    {
        $pages = $this->where('kuesioner_id', $kuesionerId)
                     ->orderBy('ordering_count', 'ASC')
                     ->findAll();

        $order = 1;
        foreach ($pages as $page) {
            $this->update($page['id'], ['ordering_count' => $order]);
            $order++;
        }
    }
}