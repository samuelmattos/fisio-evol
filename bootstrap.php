<?php
declare(strict_types=1);
require_once  __DIR__ . '/config/Config.php';
require_once  __DIR__ . '/vendor/autoload.php';

use Dopesong\Slim\Error\Whoops as WhoopsError;
use App\Provider\Doctrine;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Routing\RouteCollectorProxy;
use App\Core\Middlewares;

define('APP_ROOT', __DIR__);
if (!file_exists(APP_ROOT . '/settings.php')) {
    copy(APP_ROOT . '/settings_devel.php', APP_ROOT . '/settings.php');
}

$middleware = new Middlewares;
// $c = new Container(require __DIR__ . '/settings.php'); //Create Your container

// $c->register(new Doctrine());

$app = AppFactory::create();

// Add Routing Middleware
$app->addRoutingMiddleware();

$customErrorHandler = function (
    ServerRequestInterface $request,
    Throwable $exception,
    bool $displayErrorDetails,
    bool $logErrors,
    bool $logErrorDetails
) use ($app) {
    $payload = ['error' => $exception->getMessage()];

    $response = $app->getResponseFactory()->createResponse();
    $response->getBody()->write(
        json_encode($payload, JSON_UNESCAPED_UNICODE)
    );

    return $response;
};

// $customErrorHandler = new WhoopsError();
// $errorMiddleware = $app->addErrorMiddleware(true, true, true);
// $errorMiddleware->setDefaultErrorHandler($customErrorHandler);

// $container['phpErrorHandler'] = $container['errorHandler'] = function ($c) {
//     return new WhoopsError($c->get('settings')['displayErrorDetails']);
// };
require 'routes.php';
// $app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
//     // $response->getBody()->write("Caminho não especificado!");
//     // return $response;
//     return new \App\Controllers\errorController();
// });
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', '\App\Controllers\errorController');

$app->run();