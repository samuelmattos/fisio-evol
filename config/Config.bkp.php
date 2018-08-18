<?php

class Config
{
    const HOST_APP = '/';
    const HOST_DB = 'localhost';
    const NAME_DB = 'fisioevol';
    const PORT_DB = '3306';
    const USER_DB = 'user';
    const PASS_DB = '';
    public static function login_key()
    {
        return [
            'login' => [
                'admin' => [
                    'loggedIn' => 'admin_login',
                    'redirect' => '/login',
                    'idLoggedIn' => 'id_admin',
                ],
                'user' => [
                    'loggedIn' => 'user_login',
                    'redirect' => '/user',
                    'idLoggedIn' => 'id_user',
                ],
            ],
        ];
    }
    public static function config_email()
    {
        return [
            'email' => [
                'host' => '',
                'user' => '',
                'password' => '',
                'port' => 465,
            ],
        ];
    }
}
