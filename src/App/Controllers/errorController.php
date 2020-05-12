<?php
namespace App\Controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Core\Controller;

class errorController extends Controller
{
    public function __invoke(Request $request,Response $response, $args)
    {
        $this->view('error_404', ['title' => 'Erro', 'dados' => 'Erro']);
        $response->withStatus(404);
        $response->getBody()->write('');
        return $response;
    }
}
