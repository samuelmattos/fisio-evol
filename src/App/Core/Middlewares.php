<?php
namespace App\Core;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Config;

class Middlewares
{

    private $config;

    public function __construct()
    {
        $arr = Config::login_key();
        $this->config = (object) $arr;
    }

    public function admin()
    {
        $config = $this->config->login['admin'];

        $admin = function (Request $request, $handler) use ($config) {

            if (!isset($_SESSION[$config['loggedIn']])) {
                // return $response->withRedirect(Config::HOST_APP.$config['redirect']);
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
