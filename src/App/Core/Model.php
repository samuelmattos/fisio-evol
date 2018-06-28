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
}