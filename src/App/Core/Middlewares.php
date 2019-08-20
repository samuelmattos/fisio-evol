<?php
namespace App\Core;

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

        $admin = function ($request, $handler) use ($config) {

            if (!isset($_SESSION[$config['loggedIn']])) {
                return $response->withRedirect(Config::HOST_APP.$config['redirect']);
            }
            $response = $handler->handle($request);
            return $response;
        };
        return $admin;
    }

    public function user()
    {
        $config = $this->config->login['user'];

        $admin = function ($request, $handler) use ($config) {

            if (!isset($_SESSION[$config['loggedIn']])) {
                return $response->withRedirect(Config::HOST_APP.$config['redirect']);
            }
            $response = $handler->handle($request);
            return $response;
        };
        return $admin;
    }
}
