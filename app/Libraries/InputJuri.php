<?php 
namespace App\Libraries;

class InputJuri
{
    private $data = [];

    public function addData($clientData)
    {
        $this->data[] = $clientData;
    }

    public function getData()
    {
        return $this->data;
    }
}
