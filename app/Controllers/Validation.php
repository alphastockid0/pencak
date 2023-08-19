<?php

namespace App\Controllers;

use App\Models\NilaiTanding;

class Validation extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function validation()
    {
        $nilai = new NilaiTanding();
        $nilai->getAll();
    }
}
