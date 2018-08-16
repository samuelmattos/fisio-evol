<?php
use App\Core\Flash;
use App\Model\Admin;
use App\Model\User;
$message = new \Twig_SimpleFunction('message', function($index){
    return Flash::get($index);
});

$admin = new \Twig_SimpleFunction('admin', function(){
    return (new Admin)->user();
});

$user = new \Twig_SimpleFunction('user', function(){
    return (new User)->user();
});

$html_entity_decode = new \Twig_SimpleFunction('html_entity_decode', function ($string) {
    return html_entity_decode($string, ENT_QUOTES, "utf-8");
});

return [
    $message, $admin, $user, $html_entity_decode
];