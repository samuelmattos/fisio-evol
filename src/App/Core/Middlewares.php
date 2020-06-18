<?php
namespace App\Core;
use Config;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

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
        return new AdminMiddleware($this->responseFactory, $this->config->login['admin']);      
    }

    public function user()
    {
        return new AdminMiddleware($this->responseFactory, $this->config->login['user']);      
    }

    public function api()
    {
        return new \Tuupola\Middleware\JwtAuthentication([
            "path" => ["/api"],
            "regexp" => "/(.*)/",
            "header" => "X-Token",
            "ignore" => [
                "/api/auth/login"
            ],
            "error" => function ($response, $arguments) {
                $data["status"] = "error";
                $data["message"] = $arguments["message"];
                return $response
                    ->withHeader("Content-Type", "application/json")
                    ->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
            },
            "secret" => 'xxxxxx'
        ]);
    }

    public function error()
    {
        return new \Zeuxisoo\Whoops\Slim\WhoopsMiddleware([
            'enable' => Config::DEBUG_APP,
            'editor' => 'vscode',
            'title'  => 'Ops algo deu errado',        
        ]);
    }
}
