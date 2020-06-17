<?php
namespace App\Controllers\admin;

use App\Core\Controller;
use App\Model\User;

class painelController extends Controller
{

    private $user;

    public function __construct()
    {
        $this->user = new User;
    }
    public function index($request, $response)
    {
        $users = $this->user->
            select()->            
            busca('nome,email,telefone,documento')->
            orderBY('nome', 'ASC')->
            paginate(5)->get();
        $dados['users'] = $users;
        $dados['title'] = 'Fisioterapeutas';
        $dados['links'] = $this->user->links();
        $this->view('admin.painel', $dados);
        $response->getBody()->write('');
        return $response;
    }
}
