<?php

namespace App\Controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Core\Controller;
use App\Core\Email;
use App\Model\User;
use App\Templates\Pass;
use App\Core\Validate;
use App\Core\Password;

class homeController extends Controller
{
    public function index(Request $request,Response $response)
    {
        $this->view('home', ['title' => 'Inicio', 'dados' => 'Inicio']);
        $response->getBody()->write('');
        return $response;
    }

    public function sobre(Request $request,Response $response)
    {
        $this->view('sobre', ['title' => 'Sobre', 'dados' => 'Sobre']);
        $response->getBody()->write('');
        return $response;
    }

    public function fisioterapeutas(Request $request,Response $response)
    {
        $user = new User;
        $users = $user->
            select('nome,telefone')->            
            busca('nome')->
            orderBY('nome', 'ASC')->
            paginate(5)->get();
        $dados['users'] = $users;
        $dados['title'] = 'Fisioterapeutas';
        $dados['links'] = $user->links();

        $this->view('fisioterapeutas', $dados);
        $response->getBody()->write('');
        return $response;
    }
    
    public function remenber(Request $request, Response $response, $args)
    {
        $this->view('remenber');
        $response->getBody()->write('');
        return $response;
    }

    public function mail_send(Request $request, Response $response, $args)
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
        $data = ['Verifique sua caixa de entrada.'];
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}
