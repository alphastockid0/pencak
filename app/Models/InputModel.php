<?php

namespace App\Models;

use CodeIgniter\Model;

class InputModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['name', 'email', 'device'];
    
    public function saveUser($name, $email, $device)
    {
        $data = [
            'name' => $name,
            'email' => $email,
            'device' => $device
        ];
        
        $this->insert($data);
    }
}
