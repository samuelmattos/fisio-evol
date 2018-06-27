<?php

$file_exists = new \Twig_SimpleFunction('file_existe', function($file){
    return file_exists($file);
});

$teste = new \Twig_SimpleFunction('teste', function(){
    echo 'teste';
});

return [
    $file_exists,
    $teste
];