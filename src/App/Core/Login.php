<?php

namespace App\Core;

use App\Core\Model;
use App\Core\Password;
use Config;

class Login
{
    public function login($data, Model $model)
    {
        $arr = Config::login_key();
        $config = (object)$arr['login'][$model->typeLogin];
        $user = $model->findBy('email', $data->email);
        if (!$user) {
            $_SESSION[$config->idLoggedIn] = $user->id;
            $_SESSION[$config->loggedIn] = true;
            return false;
        }
        if (Password::verify($data->password, $user->password)) {
            return true;
        }

        return false;
    }
}
