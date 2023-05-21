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
        $g = session('gelanggang');
        $nilaiModel = new InputNilai();
        // $data = $nilaiModel->validation($g, $b);
        // var_dump($data);
        // return view('cek', ['data' => $data]);
    }
}
