<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Validate;
use App\Model\Pacientes;

class pacienteController extends Controller
{

    private $paciente;

    public function __construct()
    {
        $this->paciente = new Pacientes;
    }

    public function index()
    {
        //$pacientes = $pacientes->select()->where('id_paciente', '=', '2')->get();
        $pacientes = $this->paciente->
                    select()->
                    busca('nome,telefone')->
                    paginate(5)->get();
        $dados['pacientes'] = $pacientes;
        $dados['title'] = 'Pacientes';
        $dados['links'] = $this->paciente->links();
        $this->view('pacientes', $dados);
    }
    public function create()
    {
        $this->view('cadastra_paciente', 
        ['title' => 'Cadastrar Paciente',
        'acao' => 'Cadastrar']);
    }

    public function store()
    {
        $validate = new Validate;

        $data = $validate->validate([
            'nome' => 'required',
            'documento' => 'required',
            'telefone' => 'required:phone:max@14',
        ]);

        if ($validate->hasErrors()) {
            return back();
        }

        $this->paciente->create((array) $data);
        if ($paciente) {
            return back();
        }
    }

    public function edit($request, $response, $args)
    {
        $paciente = $this->paciente;
        $paciente = $paciente->select()->where('id_paciente', $args['id'])->first();

        $this->view('cadastra_paciente', [
            'title' => 'Editar Paciente',
            'acao' => 'Editar',
            'paciente' => $paciente,
        ]);

    }

    public function update($request, $response, $args)
    {
        $data = $validate->validate([
            'nome' => 'required',
            'documento' => 'required',
            'telefone' => 'required:phone:max@14',
        ]);

        if ($validate->hasErrors()) {
            return back();
        }

        $update = $this->paciente->find('id_paciente', $args['id'])->update((array) $data);

        if ($update) {
            return back();
        }
    }

    public function destroy($request, $response, $args)
    {
        $deleted = $this->paciente->find('id_paciente', $args['id'])->delete();
        if ($deleted) {
            return back();
        }
    }
}
