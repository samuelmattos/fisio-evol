<?php

declare(strict_types=1);
require_once  __DIR__ . '/config/Config.php';
require_once  __DIR__ . '/vendor/autoload.php';

use DI\Container;
use Slim\Factory\AppFactory;
use App\Core\Middlewares;

define('APP_ROOT', __DIR__);

$app = AppFactory::create(null, new Container());
$middleware = new Middlewares($app->getResponseFactory());
$app->add($middleware->api());
$app->add($middleware->error());

require 'routes.php';
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', '\App\Controllers\errorController');

$app->run();