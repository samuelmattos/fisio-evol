<?php
namespace App\Controllers;

use App\Core\Controller;

class errorController extends Controller
{
    public function __invoke($request, $response)
    {
        return $response
            ->withStatus(404)
            ->withHeader('Content-Type', 'text/html')
            ->write(
                $this->view('error_404', ['title' => 'Erro', 'dados' => 'Erro'])
            );
    }
}
