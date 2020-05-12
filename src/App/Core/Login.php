<?php

namespace App\Core;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Core\Model;
use App\Core\Password;
use App\Model\Admin;
use App\Core\Redirect;
use Config;

class Login
{
    private $type;

    private $config;
    
    public function __construct($type) {
		$this->type = $type;
        $arr = Config::login_key();        
        $this->config = (object)$arr['login'][$this->type];
       
	}

    public function login($data, Model $model)
    {
        if (!isset($this->type)) {
			throw new \Exception("Para fazer o login, verifique se esta passando o tipo");
        }
        $user = $model->findBy('email', $data->email);
        if (!$user) {
			return false;
        }
        if (Password::verify($data->password, $user->password)) {            
            $_SESSION[$this->config->idLoggedIn] = ($this->type == 'admin') ? $user->idadmin : $user->id_user;
            $_SESSION[$this->config->loggedIn] = true;
            return true;
        }

        return false;
    }
    public function logout(Request $request,Response $response) {
        session_destroy();
        $target = $this->config->redirect;
		return Redirect::redirect($target, $request, $response);
	}
}
