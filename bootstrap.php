<?php
declare(strict_types=1);
require_once  __DIR__ . '/config/Config.php';
require_once  __DIR__ . '/vendor/autoload.php';

use App\Core\Middlewares;
use Dopesong\Slim\Error\Whoops as WhoopsError;
use App\Provider\Doctrine;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

define('APP_ROOT', __DIR__);
if (!file_exists(APP_ROOT . '/settings.php')) {
    copy(APP_ROOT . '/settings_devel.php', APP_ROOT . '/settings.php');
}

$middleware = new Middlewares;
// $c = new Container(require __DIR__ . '/settings.php'); //Create Your container

// $c->register(new Doctrine());

// $app = new \Slim\App($c);
$app = AppFactory::create();
$container = $app->getContainer();

$container['phpErrorHandler'] = $container['errorHandler'] = function ($c) {
    return new WhoopsError($c->get('settings')['displayErrorDetails']);
};
$container['notFoundHandler'] = function ($c) {
    return new \App\Controllers\errorController();
};
require 'routes.php';
$app->run();