<?php

$app->get('/', '\App\Controllers\homeController:index');
$app->get('/home', '\App\Controllers\homeController:index');
$app->get('/remenber', '\App\Controllers\homeController:remenber');
$app->get('/fisioterapeutas', '\App\Controllers\homeController:fisioterapeutas');
$app->post('/send_email', '\App\Controllers\homeController:mail_send');
$app->get('/sobre', '\App\Controllers\homeController:sobre');

$app->get('/contato', '\App\Controllers\contatoController:index');
$app->post('/contato/store', '\App\Controllers\contatoController:store');

$app->get('/register', '\App\Controllers\registerController:index');
$app->post('/user/inscrever', '\App\Controllers\inscreverController:index');

$app->get('/login', '\App\Controllers\loginController:index');
$app->post('/access', '\App\Controllers\admin\adminController:store');
$app->group('/admin', function () use ($app) {
    $app->get('/painel', '\App\Controllers\admin\painelController:index');
    $app->get('/user/edit/{id}', '\App\Controllers\admin\adminController:userEdit');
    $app->post('/user/update', '\App\Controllers\admin\adminController:userUpdate');
    $app->get('/logout', '\App\Controllers\admin\adminController:destroy');
})->add($middleware->admin());

$app->get('/userLogin', '\App\Controllers\loginController:user');
$app->post('/userAccess', '\App\Controllers\user\userController:store');
$app->post('/register', '\App\Controllers\user\userController:register');
$app->group('/user', function () use ($app) {
    $app->get('/perfil', '\App\Controllers\user\userController:perfil');
    $app->post('/perfil/update', '\App\Controllers\user\userController:update');
    include ('src/App/Rotas/paciente_route.php');
    include ('src/App/Rotas/evolucao_route.php');
    $app->get('/logout', '\App\Controllers\user\userController:destroy');
})->add($middleware->user());