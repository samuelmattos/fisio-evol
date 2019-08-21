<?php
namespace App\Core;
use Config;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class Redirect{

    public static function redirect($target, $request, $response){
        $target = Config::HOST_APP.$target;        
        return $response
            ->withHeader('Location', $target)->withStatus(302);
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