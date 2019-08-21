<?php

namespace App\Controllers;
use App\Core\Controller;

class loginController extends Controller
{
    public function index($request, $response)
    {
        $this->view('login', ['title' => 'Login', 'dados' => 'Login']);
        $response->getBody()->write('');
        return $response;
    }

    public function user($request, $response)
    {
        $this->view('login_user', ['title' => 'Login', 'dados' => 'Login']);
        $response->getBody()->write('');
        return $response;
    }
}
