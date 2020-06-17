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


$container = new Container();
AppFactory::setContainer($container);
$app = AppFactory::create();
$middleware = new Middlewares($app->getResponseFactory());
$app->addErrorMiddleware(true, true, true);
$app->add(new Tuupola\Middleware\JwtAuthentication([
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
]));
// Add Routing Middleware
$app->addRoutingMiddleware();

// $customErrorHandler = function (
//     ServerRequestInterface $request,
//     Throwable $exception,
//     bool $displayErrorDetails,
//     bool $logErrors,
//     bool $logErrorDetails
// ) use ($app) {
//     $payload = ['error' => $exception->getMessage()];

//     $response = $app->getResponseFactory()->createResponse();
//     $response->getBody()->write(
//         json_encode($payload, JSON_UNESCAPED_UNICODE)
//     );

//     return $response;
// };

require 'routes.php';
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', '\App\Controllers\errorController');

$app->run();