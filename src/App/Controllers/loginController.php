<?php

namespace App\Controllers;
use App\Core\Controller;

class loginController extends Controller
{
    public function index()
    {
        $this->view('login', ['title' => 'Login', 'dados' => 'Login']);
    }
}
