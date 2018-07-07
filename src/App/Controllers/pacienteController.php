<?php

namespace App\Controllers;
use App\Core\Controller;
use App\Core\Validate;
use App\Model\Pacientes;

class pacienteController extends Controller
{

    private $paciente;

    public function __construct(){
        $this->paciente = new Pacientes;
    }

    public function index(){
        
        //$pacientes = $pacientes->select()->where('idpacientes', '=', '2')->get();
        $pacientes = $this->paciente->select()->get();
        $dados['pacientes'] = $pacientes;
        $dados['title'] = 'Pacientes';
        $this->view('pacientes', $dados);
    }
    public function create()
    {
        $this->view('cadastra_paciente', ['title' => 'Paciente']);
    }

    public function store()
    {
        $validate = new Validate;
        
        $data = $validate->validate([
            'nome' => 'required',
            'documento' => 'required',
            'telefone' => 'required:phone:max@14'
        ]);

        if($validate->hasErrors()){
            return back();
        }
               
        $this->paciente->create((array)$data);
        if($paciente){
           return back();
        }
    }

    public function edit($request, $response, $args){
        $paciente = $this->paciente;
        $paciente = $paciente->select()->where('idpaciente', $args['id'])->first();

        $this->view('paciente', [
            'title' => 'Editar Paciente',
            'paciente' => $paciente
        ]);

    }

    public function update($request, $response, $args){
        $data = $validate->validate([
            'nome' => 'required',
            'documento' => 'required',
            'telefone' => 'required:phone:max@14'
        ]);

        if($validate->hasErrors()){
            return back();
        }

       $update = $paciente = $this->paciente;
        $paciente->find('idpaciente', $args['id'])->update((array)$data);

        if($update){
            return back();
        }
    }
}
