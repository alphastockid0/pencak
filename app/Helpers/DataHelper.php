<?php 

namespace App\Helpers;

use App\Libraries\InputJuri;

if (!function_exists('collectData')) {
    function collectData($clientData)
    {
        $dataCollector = new InputJuri();
        $dataCollector->addData($clientData);
    }
}
