<?php

namespace App\Controllers\user;

use App\Core\Controller;
use App\Core\Validate;
use App\Model\Pacientes;

class pacienteController extends Controller
{

    private $paciente;
    private $user;
    public function __construct()
    {
        $this->paciente = new Pacientes;
    }

    public function index()
    {
        $pacientes = $this->paciente->get_pacientes();
        $dados['pacientes'] = $pacientes;
        $dados['title'] = 'Pacientes';
        $dados['links'] = $this->paciente->links();
        $this->view('user.pacientes', $dados);
    }
    public function create()
    {
        $this->view('user.cadastra_paciente',
            ['title' => 'Cadastrar Paciente',
                'form' => 'pacientes/cadastro',
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

        $id_paciente = $this->paciente->create((array) $data);

        if ($id_paciente) {
            $this->paciente->add_paciente_user($id_paciente);
            return back();
        }
    }

    public function edit($request, $response, $args)
    {
        $paciente = $this->paciente;
        $paciente = $paciente->select()->where('id_paciente', $args['id'])->first();

        $this->view('user.cadastra_paciente', [
            'title' => 'Editar Paciente',
            'form' => 'editar/'. $paciente->id_paciente,
            'acao' => 'Editar',
            'paciente' => $paciente,
        ]);

    }

    public function update($request, $response, $args)
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
