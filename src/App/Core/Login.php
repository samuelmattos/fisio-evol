<?php

namespace App\Core;

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
            $_SESSION[$this->config->idLoggedIn] = $user->idadmin;
            $_SESSION[$this->config->loggedIn] = true;
            return true;
        }

        return false;
    }
    public function logout() {
		session_destroy();

		return Redirect::redirect($this->config->redirect);

	}
}
