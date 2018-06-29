<?php
use App\Core\Flash;

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

function flash($index, $message){
    Flash::add($index, $message );
}

function error($message){
    return "<span class='alert-error'> * {$message} </span>";
}

function success($message){
    return "<span class='alert-error'> * {$message} </span>";
}