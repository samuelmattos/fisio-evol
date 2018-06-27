<?php

namespace App\Controllers;

use App\Core\Controller;

class inscreverController 
{
    public function index($request, $response)
    {
        echo json_encode('usuário se inscreveu');
    }
}
