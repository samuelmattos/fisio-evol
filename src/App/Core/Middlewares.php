<?php
namespace App\Core;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Config;

class Middlewares 
{

    private $config;
    private $responseFactory;
    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $arr = Config::login_key();
        $this->config = (object) $arr;
        $this->responseFactory = $responseFactory;
    }

    public function admin()
    {
        return new AdminMiddleware($this->responseFactory);      
    }

    public function user()
    {
        $config = $this->config->login['user'];

        $admin = function (Request $request, $handler) use ($config) {

            if (!isset($_SESSION[$config['loggedIn']])) {
                $response = $handler->handle($request);
                $target = Config::HOST_APP.$config['redirect'];
                return $response
                    ->withHeader('Location', $target)
                    ->withStatus(302);
            }
            $response = $handler->handle($request);
            return $response;
        };
        return $admin;
    }
}
