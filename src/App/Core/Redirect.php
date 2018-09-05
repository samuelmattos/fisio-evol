<?php
namespace App\Core;
use Config;

class Redirect{

    public static function redirect($target){
        $target = Config::HOST_APP.$target;
       
        header("location: {$target}", true);
        exit();
    }

    public static function back(){       
        $previous = "javascript:history.go(-1);";
       
        if(isset($_SERVER['HTTP_REFERER'])){
            $previous = $_SERVER['HTTP_REFERER'];
        }
        header("location: {$previous}");
        exit();
    }
    

}