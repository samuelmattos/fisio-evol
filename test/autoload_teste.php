<?php

if(!file_exists('../config/Config.php')){
    $arquivo_origem = '../config/Config.bkp.php';
    $arquivo_destino = '../config/Config.php';
    copy($arquivo_origem, $arquivo_destino);
}

require '../vendor/autoload.php';