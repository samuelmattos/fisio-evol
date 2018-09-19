<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Email;
use App\Model\User;
use App\Templates\Pass;
use App\Core\Validate;
use App\Core\Password;

class homeController extends Controller
{
    public function index($request, $response)
    {
        $this->view('home', ['title' => 'Inicio', 'dados' => 'Inicio']);
    }

    public function fisioterapeutas($request, $response)
    {
        $this->view('home', ['title' => 'Fisioterapeutas', 'dados' => 'Fisioterapeutas']);
    }
    
    public function remenber()
    {
        $this->view('remenber');
    }

    public function mail_send($request, $response, $args)
    {   
        $validate = new Validate;
        $data = $validate->validate([
            'email' => 'required'
        ]);
        
        if ($validate->hasErrors()) {
            return back();
        }
        $email = $data->email;
        $user = new User();
        $findUser = $user->findBy('email', $email);

        if(!$findUser){
            return json_encode(['dados'=>'E-mail não cadastrado!']);
        }
        $nova_senha = mt_rand();
        $findUser->password = Password::make($nova_senha);
        $update = $user->find('id_user', $findUser->id_user)->update((array) $findUser, 'id_user');        
        $email = new Email;
        $email->data([
            'toName' => $findUser->nome,
            'toEmail' => $findUser->email,
            'assunto' => 'Fisio Evol (Configuração)',
            'fromName' => 'Fisio Evol',
            'fromEmail' => 'contato@fisioevol.com.br',
            'pass' => $nova_senha,
        ])->template(new Pass)->send();
        return json_encode(['Verifique sua caixa de entrada.']);
    }
}
