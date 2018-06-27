<?php

namespace App\Controllers;
use App\Core\Controller;

class sobreController extends Controller
{
    public function index()
    {
        $this->view('sobre', ['title' => 'Sobre', 'dados' => 'Sobre']);
    }
}
