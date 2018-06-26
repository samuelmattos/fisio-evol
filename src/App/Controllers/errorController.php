<?php
namespace App\Controllers;

use App\Core\Controller;
use \Psr\Http\Message\ServerRequestInterface;
use \Psr\Http\Message\ResponseInterface;

class errorController extends Controller
{
    public function __invoke($request, $response)
    {
        return $response
            ->withStatus(404)
            ->withHeader('Content-Type', 'text/html')
            ->write($this->loadTemplate('error_404', $this->getData()));
	}
}