<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
if(!file_exists('config/Config.php')){
    $arquivo_origem = 'config/Config.bkp.php';
    $arquivo_destino = 'config/Config.php';
    copy($arquivo_origem, $arquivo_destino);
}

require 'vendor/autoload.php';