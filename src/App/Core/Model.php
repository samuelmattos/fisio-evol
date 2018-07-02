<?php
namespace App\Core;
use App\Core\Connection;

class Model {
    protected $db;
    public function __construct() {
        $this->db = Connection::connect();
    }

    public function all(){
        $sql = "select * from {$this->table}";
        $all = $this->db->query($sql);
        $all->execute();
        return $all->fetchAll();
    }

    public function find($field, $value){
        $sql = "select * from {$this->table} where {$field} = :{$field} ";
        $find = $this->db->prepare($sql);
        $find->bindValue($field, $value);
        $find->execute();
        return $all->fetch();
    }
}