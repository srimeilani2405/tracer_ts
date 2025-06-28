<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password', 'role', 'is_approved'];
    protected $useTimestamps = true;

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}
