<?php
namespace App\Core;
use PDO;
use Config;
class Connection {

    public static function connect(){
        $pdo = new PDO("mysql:host=".Config::HOST_DB.".;dbname=".Config::NAME_DB.";charset=utf8;port=".Config::PORT_DB, Config::USER_DB, COnfig::PASS_DB);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
        return $pdo;
    }
}