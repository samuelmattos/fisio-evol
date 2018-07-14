<?php
use App\Core\Flash;
use App\Core\Redirect;

function dd($data)
{
    echo ($data);
    die();
}

function json($data)
{
    headr('Content-Type: applictaion/json');
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
    return "<div class=\"ui pointing red basic label\" style=\"color: #ffffff!important\"> * {$message} </div>";
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
