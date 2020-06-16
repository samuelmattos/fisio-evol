<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Firebase\JWT\JWT;

$app->get('/api/auth/login', function (Request $request,Response $response, $args) {
    $key = 'xxxxxx';
    $token = array(
        "user" => "@samuelmattos",
        "twitter" => "https://twitter.com/samuelmattos",
        "github" => "https://github.com/samuelmattos"
    );
    $jwt = JWT::encode($token, $key);
    $payload = json_encode(["auth-jwt" => $jwt]);
    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
});
$app->get('/api/teste', function (Request $request,Response $response, $args) {
   
    $payload = json_encode(["status" => "teste"]);
    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
});
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

$app->get('/fe-admin', '\App\Controllers\loginController:index');
$app->post('/access', '\App\Controllers\admin\adminController:store');
$app->group('/admin', function ($group) {
    $group->get('/painel', '\App\Controllers\admin\painelController:index');
    $group->get('/user/edit/{id}', '\App\Controllers\admin\adminController:userEdit');
    $group->post('/user/update', '\App\Controllers\admin\adminController:userUpdate');
    $group->get('/logout', '\App\Controllers\admin\adminController:destroy');
})->add($middleware->admin());

$app->get('/userLogin', '\App\Controllers\loginController:user');
$app->post('/userAccess', '\App\Controllers\user\userController:store');
$app->post('/register', '\App\Controllers\user\userController:register');
$app->group('/user',  function ($group) {
    $group->get('/perfil', '\App\Controllers\user\userController:perfil');
    $group->post('/perfil/update', '\App\Controllers\user\userController:update');
    include ('src/App/Rotas/paciente_route.php');
    include ('src/App/Rotas/evolucao_route.php');
    $group->get('/logoutu', '\App\Controllers\user\userController:destroy');
})->add($middleware->user());