<?php

namespace App\traits;

trait Create{

    public function create($attributes){

        $sql = "insert into {$this->table}(";
        $sql.= implode(',', array_keys($attributes)).') values(';
        $sql.= ":".implode(', :',array_keys($attributes)).')';
        $create = $this->connect->prepare($sql);

        $create->execute($attributes);

        return $this->connect->lastInsertId();
    }

}