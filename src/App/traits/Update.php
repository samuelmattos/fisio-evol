<?php

namespace App\traits;

trait Update{

    public function update($attributes){
        
        if(!isset($this->field) or !isset($this->value)){
            throw new \Exception("Antes de fazer o update, por favor chame o find");
        }

        $sql = "update {$this->table} set ";

        foreach($attributes as $field => $value){
            $sql.= $field."= :{$field},";
        }

        $sql = rtrim($sql,',');

        $sql.= " where {$this->field} = :{$this->field}";

        $attributes['id'] = $this->value;

        $update = $this->connect->prepare($sql);
        $update->execute($attributes);

        return $update->rowCount();

    }

}