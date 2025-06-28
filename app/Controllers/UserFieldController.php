<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserFieldModel;

class UserFieldController extends BaseController
{
    public function index()
    {
        $model = new UserFieldModel();
        $fields = $model->getUserFields();

        return $this->response->setJSON([
            'success' => true,
            'data' => $fields
        ]);
    }
}
