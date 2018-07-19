<?php

namespace App\Controllers\user;

use App\Core\Controller;
use App\Core\Validate;
use App\Model\User;
use App\Model\Evolucao;
use App\Model\Pacientes;

class evolucaoController extends Controller
{
    private $paciente;
    private $evolucao;
    private $user;
    public function __construct()
    {
        $this->user = (new User)->user();
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

    public function create($request, $response, $args)
    {
        //alem do paciente tenho que encaminhar as evolucao
        $this->view('user.cadastra_evolucao', $args);
    }

    public function store($request, $response, $args)
    {
        
        $validate = new Validate;
        $data = $validate->validate([
            'descricao' => 'required',
            'data' => 'required',
        ]);

        if ($validate->hasErrors()) {
            return $this->create();
        }
        /**
        *Terminei a validação, agora estou pegando o id do usuário,
        * tenho que pegar o id do paciente esqueci de mandar por parametro no form.
        */
        $user = $this->user;
        $data->id_user = $user->id_user;
        $this->evolucao = new Evolucao;
        $evolucao = $this->evolucao->create((array) $data);

        if ($evolucao) {
            $this->view('user.cadastra_evolucao', array());
        }
    }
}
