<?php
namespace App\Core;
use Config;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Redirect{

    public static function redirect($target,Request $request, Response $response){
        $target = Config::HOST_APP.$target;
        return $response
            ->withHeader('Location', $target)
            ->withStatus(302);
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