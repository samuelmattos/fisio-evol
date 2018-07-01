<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';
$c = new \Slim\Container(); //Create Your container

//Override the default Not Found Handler
$c = [
    'settings' => [
        'displayErrorDetails' => true
    ],
    'notFoundHandler' => function ($c) {
        return new \App\Controllers\errorController();
    },
];

$app = new \Slim\App($c);

$app->get('/', '\App\Controllers\homeController:index');
$app->get('/home', '\App\Controllers\homeController:index');
$app->get('/sobre', '\App\Controllers\sobreController:index');
$app->get('/login', '\App\Controllers\loginController:index');
$app->get('/evolucao', '\App\Controllers\evolucaoController:index');
$app->get('/register', '\App\Controllers\registerController:index');
$app->get('/pacientes', '\App\Controllers\pacienteController:create');
$app->post('/pacientes/cadastro', '\App\Controllers\pacienteController:store');
$app->post('/user/inscrever', '\App\Controllers\inscreverController:index');

$app->run();
