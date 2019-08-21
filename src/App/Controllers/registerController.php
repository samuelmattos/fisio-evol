<?php

namespace App\Controllers;
use App\Core\Controller;

class registerController extends Controller
{
    public function index($request, $response)
    {
        $this->view('register', ['title' => 'Registro', 'dados' => 'Register']);
        $response->getBody()->write('');
        return $response;
    }
}
