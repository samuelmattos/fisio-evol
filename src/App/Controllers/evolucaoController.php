<?php

namespace App\Controllers;
use App\Core\Controller;

class evolucaoController extends Controller
{
    public function index()
    {
        $this->data['dados'] = 'evolucao';
        $this->loadTemplate('Evolucao', $this->getData());
    }
}
