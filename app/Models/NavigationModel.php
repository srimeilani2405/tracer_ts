<?php

namespace App\Models;

use CodeIgniter\Model;

class NavigationModel extends Model
{
    protected $table = 'navigation_links';
    protected $primaryKey = 'id';
    protected $allowedFields = ['label', 'url', 'is_active'];
}
