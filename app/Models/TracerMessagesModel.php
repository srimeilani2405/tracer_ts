<?php

namespace App\Models;

use CodeIgniter\Model;

class TracerMessagesModel extends Model
{
    protected $table = 'tracer_messages';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title', 
        'greeting', 
        'content', 
        'signature', 
        'eligibility_years', 
        'is_active', 
        'created_at', 
        'updated_at'
    ];
}