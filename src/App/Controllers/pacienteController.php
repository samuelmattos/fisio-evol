<?php

namespace App\Controllers;
use App\Core\Controller;
use App\Core\Validate;
use App\Model\Pacientes;

class pacienteController extends Controller
{
    public function create()
    {
        $this->view('paciente', ['title' => 'Paciente']);
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
        
        $paciente = new Pacientes();           
        $paciente->create((array)$data);
        if($paciente){
           return back();
        }
    }
}
