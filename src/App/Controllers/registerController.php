<?php

namespace App\Controllers;
use App\Core\Controller;

class registerController extends Controller
{
    public function index()
    {
        $this->view('register', ['title' => 'Registro', 'dados' => 'Register']);
    }
}
