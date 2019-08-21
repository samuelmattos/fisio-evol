<?php

namespace App\Controllers;

use App\Core\Controller;

class inscreverController 
{
    public function index($request, $response)
    {
        $data = ['usuário se inscreveu'];
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}
