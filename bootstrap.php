<?php
declare(strict_types=1);
require_once  __DIR__ . '/config/Config.php';
require_once  __DIR__ . '/vendor/autoload.php';
use DI\Container;
use Slim\Factory\AppFactory;
use App\Core\Middlewares;

define('APP_ROOT', __DIR__);
if (!file_exists(APP_ROOT . '/settings.php')) {
    copy(APP_ROOT . '/settings_devel.php', APP_ROOT . '/settings.php');
}

$middleware = new Middlewares;
$container = new Container();
AppFactory::setContainer($container);
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

require 'routes.php';
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', '\App\Controllers\errorController');

$app->run();