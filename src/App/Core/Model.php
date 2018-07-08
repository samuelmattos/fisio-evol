<?php
namespace App\Core;
use App\Core\Connection;

use App\traits\Read;
use App\traits\Create;
use App\traits\Delete;
use App\traits\Update;

abstract class Model {

    use Create, Read, Update, Delete;
    
    protected $connect;
    protected $field;
    protected $value;

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
       $this->field = $field;
       $this->value = $value;
       return $this;
    }
}