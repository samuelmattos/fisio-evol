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
        return new AdminMiddleware($this->responseFactory, $this->config->login['admin']);      
    }

    public function user()
    {
        return new AdminMiddleware($this->responseFactory, $this->config->login['user']);      
    }
}
