<?php
namespace App\Controllers;
use App\Core\Controller;

class errorController extends Controller
{
    public function __invoke($request, $response)
    {
        $response->withStatus(404);
        $response->getBody()->write($this->view('error_404', ['title' => 'Erro', 'dados' => 'Erro']));
        return $response;
    }
}
