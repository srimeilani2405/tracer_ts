<?php

namespace App\Models;

use CodeIgniter\Model;

class WelcomeModel extends Model
{
    protected $table = 'welcome_message';
    protected $primaryKey = 'id';
    protected $allowedFields = ['message'];

    public function getWelcomeMessage()
    {
        $data = $this->select('message')->where('id', 1)->first();
        return $data ? $data['message'] : '';
    }

    public function saveMessage($message)
    {
        $existing = $this->find(1);
        if ($existing) {
            $this->update(1, ['message' => $message]);
        } else {
            $this->insert(['id' => 1, 'message' => $message]);
        }
    }
}
