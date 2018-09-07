<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
require '../config/Config.php';
require '../vendor/autoload.php';

use App\Core\Middlewares;
use Dopesong\Slim\Error\Whoops as WhoopsError;

$middleware = new Middlewares;
$c = new \Slim\Container(); //Create Your container

$app = new \Slim\App($c);
include '../bootstrap.php';

$app->run();
