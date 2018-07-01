<?php

namespace App\Controllers;
use App\Core\Controller;
use App\Core\Validate;
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
            'telefone' => 'required:phone'
        ]);
        if($validate->hasErrors()){
            return back();
        }
       
        dd($data);
    }
}
