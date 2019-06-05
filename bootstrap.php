<?php
declare(strict_types=1);
require_once  __DIR__ . '/config/Config.php';
require_once  __DIR__ . '/vendor/autoload.php';

use App\Core\Middlewares;
use Dopesong\Slim\Error\Whoops as WhoopsError;
use App\Provider\Doctrine;
use Slim\Container;

define('APP_ROOT', __DIR__);
if (!file_exists(APP_ROOT . '/settings.php')) {
    copy(APP_ROOT . '/settings_devel.php', APP_ROOT . '/settings.php');
}

$middleware = new Middlewares;
$c = new Container(require __DIR__ . '/settings.php'); //Create Your container

$c->register(new Doctrine());

$app = new \Slim\App($c);

$container = $app->getContainer();

$container['phpErrorHandler'] = $container['errorHandler'] = function ($c) {
    return new WhoopsError($c->get('settings')['displayErrorDetails']);
};
$container['notFoundHandler'] = function ($c) {
    return new \App\Controllers\errorController();
};
require 'routes.php';
$app->run();