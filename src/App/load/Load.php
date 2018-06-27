<?php
namespace App\load;

class Load {

    public static function file ($file) {
        $file = path().$file;
        if(!file_exists($file)){
            throw new \Exception("Esse arquivo {$file} não existe");
        }
        return require $file;
    }
}