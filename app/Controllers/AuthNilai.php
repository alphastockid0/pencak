<?php

namespace App\Controllers;

use App\Models\InputNilai;

class AuthNilai extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function auth()
    {
        $nilaiModel = new InputNilai();
        $data = $nilaiModel->validation();
        return view('cek', ['data' => $data]);
    }
}
