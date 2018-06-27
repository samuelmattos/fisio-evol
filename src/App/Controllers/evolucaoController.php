<?php

namespace App\Controllers;
use App\Core\Controller;

class evolucaoController extends Controller
{
    public function index()
    {
        $this->view('evolucao', ['title' => 'Evolução', 'dados' => 'Evolução']);
    }
}
