<?php

class Config
{
    const HOST_APP = 'http://localhost/fisio-evol/';
    const HOST_DB = 'localhost';
    const NAME_DB = 'fisioevol';
    const PORT_DB = '3306';
    const USER_DB = 'user';
    const PASS_DB = '';
    public static function login_key(){
        return [
            'login' => [
                'admin' => [
                    'loggedIn' => 'admin_login',
                    'redirect' => '/login',
                    'idLoggedIn' => 'id_admin'
                ],
                'user' => [
                    'loggedIn' => 'user_login',
                    'redirect' => '/user',
                    'idLoggedIn' => 'id_user'
                ]
            ],
        ];
    }
    public static function config_email()
    {
        return [
            'email' => [
                'host' => 'smtp.mailtrap.io',
                'user' => '7f21a8e1602cbf',
                'password' => '181f5a2787f369',
                'port' => 465,
            ],
        ];
    }
}
