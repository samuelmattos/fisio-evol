<?php
namespace App\Core;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Server\MiddlewareInterface;
use Config;

class AdminMiddleware implements MiddlewareInterface
{

    private $config;
    private $responseFactory;
    public function __construct(ResponseFactoryInterface $responseFactory, $arr)
    {
        $this->config = $arr;
        $this->responseFactory = $responseFactory;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {       
        $config = $this->config;
        if (!isset($_SESSION[$config['loggedIn']])) {
            $response = $this->responseFactory->createResponse();
            $target = Config::HOST_APP.$config['redirect'];
            return $response
                ->withHeader('Location', $target)
                ->withStatus(302);
        }
        return $handler->handle($request);
    }
}