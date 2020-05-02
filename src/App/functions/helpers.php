<?php
use App\Core\Flash;
use App\Core\Redirect;

function dd($data)
{
    var_dump($data);
    die();
}

function json($data)
{
    header('Content-Type: applictaion/json');
    echo json_encode($data);
}

function path()
{
    $vendoDir = dirname(dirname(__FILE__));
    return dirname($vendoDir);
}

function flash($index, $message)
{
    Flash::add($index, $message);
}

function error($message)
{
    return '<div class="alert alert-danger" role="alert">
            *'. $message .'
        </div>';
}

function success($message)
{
    return "<span class='alert-success'> * {$message} </span>";
}

function back()
{
    return Redirect::back();
}

function busca()
{
    return filter_input(INPUT_GET, 's', FILTER_SANITIZE_STRING);
}
