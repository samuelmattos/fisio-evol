<?php

function dd($data){
    print_r($data);
    die();
}

function json($data){
    headr('Content-Type: applictaion/json');
    echo json_encode($data);
}

function path(){
$vendoDir = dirname(dirname(__FILE__));
return dirname($vendoDir);
}
?>