<?php

namespace App\Controllers;
use App\Core\Controller;
use App\Model\Pacientes;

class evolucaoController extends Controller
{
    public function index()
    {
        $pacientes = new Pacientes();
        $pacientes = $pacientes->all();
        $dados['pacientes'] = $pacientes;
        $dados['title'] = 'Evolução';
        $this->view('evolucao', $dados);
    }
}
