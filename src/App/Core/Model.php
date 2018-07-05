<?php
namespace App\Core;
use App\Core\Connection;

use App\traits\Read;
use App\traits\Create;
use App\traits\Delete;
use App\traits\Update;

class Model {

    use Create, Read, Update, Delete;
    
    protected $connect;
    public function __construct() {
        $this->connect = Connection::connect();
    }

    public function all(){
        $sql = "select * from {$this->table}";
        $all = $this->connect->query($sql);
        $all->execute();
        return $all->fetchAll();
    }

    public function find($field, $value){
        $sql = "select * from {$this->table} where {$field} = :{$field} ";
        $find = $this->connect->prepare($sql);
        $find->bindValue($field, $value);
        $find->execute();
        return $all->fetch();
    }
}