<?php

namespace App\Controllers\user;

use App\Core\Controller;
use App\Model\Pacientes;

class evolucaoController extends Controller
{

    private $paciente;

    public function __construct()
    {
        $this->paciente = new Pacientes;
    }

    public function index($request, $response, $args)
    {
        //alem do paciente tenho que encaminhar as evolucao
        $paciente = $this->paciente;
        $paciente = $paciente->select()->where('id_paciente', $args['id'])->first();
        $dados['paciente'] = $paciente;
        $dados['title'] = 'Evolução';
        $dados['evolucoes'] = array();
        $this->view('user.evolucao', $dados);
    }

    public function create()
    {
        //alem do paciente tenho que encaminhar as evolucao
        $this->view('user.cadastra_evolucao', array());
    }
}
