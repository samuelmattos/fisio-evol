<?php
use App\Core\Flash;

$message = new \Twig_SimpleFunction('message', function($index){
    return Flash::get($index);
});

return [
    $message
];