<?php namespace App\Models;

use CodeIgniter\Model;

class AdminJurusanMessageModel extends Model
{
    // Konfigurasi dasar model
    protected $table      = 'admin_jurusan_messages';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    
    // Aktifkan soft deletes jika diperlukan
    protected $useSoftDeletes = false;
    
    // Field yang boleh diisi
    protected $allowedFields = [
        'title',
        'greeting', 
        'message_content',
        'closing',
        'signature',
        'footer',
        'is_active'
    ];
    
    // Pengaturan timestamp
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    
    // Validasi input
    protected $validationRules = [
        'title'          => 'required|max_length[255]',
        'greeting'       => 'required|max_length[255]',
        'message_content'=> 'required',
        'closing'        => 'required|max_length[255]',
        'signature'      => 'required|max_length[255]',
        'footer'        => 'required',
        'is_active'      => 'permit_empty|in_list[0,1]'
    ];
    
    protected $validationMessages = [
        'title' => [
            'required' => 'Judul pesan wajib diisi',
            'max_length' => 'Judul maksimal 255 karakter'
        ],
        'greeting' => [
            'required' => 'Sapaan wajib diisi',
            'max_length' => 'Sapaan maksimal 255 karakter'
        ],
        // Pesan validasi lainnya...
    ];
    
    // Event callback
    protected $beforeInsert = ['escapeData'];
    protected $beforeUpdate = ['escapeData'];
    
    /**
     * Mendapatkan pesan aktif untuk admin jurusan
     */
    public function getActiveMessage()
    {
        return $this->where('is_active', 1)->first();
    }
    
    /**
     * Mendapatkan semua pesan dengan pagination
     */
    public function getAllMessages($perPage = 10)
    {
        return $this->orderBy('created_at', 'DESC')
                   ->paginate($perPage);
    }
    
    /**
     * Mengaktifkan pesan tertentu
     */
    public function activateMessage($id)
    {
        // Nonaktifkan semua pesan terlebih dahulu
        $this->where('is_active', 1)
             ->set(['is_active' => 0])
             ->update();
             
        // Aktifkan pesan yang dipilih
        return $this->update($id, ['is_active' => 1]);
    }
    
    /**
     * Escape data sebelum insert/update
     */
    protected function escapeData(array $data)
    {
        if (isset($data['data'])) {
            foreach ($data['data'] as $key => $value) {
                if (is_string($value)) {
                    $data['data'][$key] = esc($value);
                }
            }
        }
        return $data;
    }
}