<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
require 'vendor/autoload.php';
use Dopesong\Slim\Error\Whoops as WhoopsError;

$c = new \Slim\Container(); //Create Your container

//Override the default Not Found Handler
$c = [
    'notFoundHandler' => function ($c) {
        return new \App\Controllers\errorController();
    },
];

$app = new \Slim\App($c);
$container = $app->getContainer();

$container['phpErrorHandler'] = $container['errorHandler'] = function($c) {
    return new WhoopsError($c->get('settings')['displayErrorDetails']);
};

$app->get('/', '\App\Controllers\homeController:index');
$app->get('/home', '\App\Controllers\homeController:index');
$app->get('/sobre', '\App\Controllers\sobreController:index');
$app->get('/login', '\App\Controllers\loginController:index');
$app->get('/register', '\App\Controllers\registerController:index');
$app->get('/pacientes', '\App\Controllers\pacienteController:index');
$app->post('/pacientes/cadastro', '\App\Controllers\pacienteController:store');
$app->get('/paciente', '\App\Controllers\pacienteController:create');
$app->get('/pacientes/edit/{id}', '\App\Controllers\pacienteController:edit');
$app->get('/pacientes/remove/{id}', '\App\Controllers\pacienteController:destroy');
$app->post('/user/inscrever', '\App\Controllers\inscreverController:index');

$app->post('/access', '\App\controllers\admin\adminController:store');
$app->get('/admin', '\App\Controllers\admin\adminController:index');
$app->get('/admin/logout', 'App\Controllers\admin\adminController:destroy');
$app->get('/painel', '\App\Controllers\admin\painelController:index');

$app->run();
