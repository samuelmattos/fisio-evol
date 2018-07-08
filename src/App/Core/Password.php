<?php

namespace App\Core;

class Password {

    public static function make($password){
        $options = [
            'cost' => 12,
        ];
        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    public static function verify($password, $hash){
        return password_verify($password, $hash);
    }
}