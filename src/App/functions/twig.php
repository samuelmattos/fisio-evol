<?php
use App\Core\Flash;
use App\model\Admin;
$message = new \Twig_SimpleFunction('message', function($index){
    return Flash::get($index);
});


$admin = new \Twig_SimpleFunction('admin', function(){
    return (new Admin)->user();
});

return [
    $message, $admin
];