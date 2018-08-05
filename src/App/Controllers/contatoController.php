<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Email;
use App\Core\Validate;
use App\Templates\Contato;
use App\Core\Redirect;
class contatoController extends Controller
{
    public function index($request, $response)
    {
        $this->view('contato', ['title' => 'Contato', 'dados' => 'Fale Conosco']);
    }

    public function store($request, $response, $args)
    {
        $validate = new Validate;
        $data = $validate->validate([
            'email' => 'required',
            'nome' => 'required',
            'mensagem' => 'required',
        ]);

        if ($validate->hasErrors()) {
            return $this->create();
        }
        $email = new Email;
        $email->data([
            'toName' => 'Fisio Evol',
            'toEmail' => 'contato@fisioevol.com.br',
            'assunto' => 'contato portal',
            'fromName' => $data->nome,
            'fromEmail' => $data->email,
            'mensagem' => $data->mensagem,
        ])->template(new Contato)->send();
        Redirect::redirect('contato'); 
    }
}
