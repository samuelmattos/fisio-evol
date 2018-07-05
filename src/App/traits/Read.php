<?php

namespace App\traits;

trait Read{

    private $sql;

    private $binds;

    public function select($fields = '*'){
       $this->sql = "select {$fields} from {$this->table}";
       
       return $this;
    }

    public function where(){
        
        $num_args = func_num_args();

        $args = func_get_args();

        $args = $this->whereArgs($num_args,$args);

        $this->sql.= " where {$args['field']} {$args['sinal']} :{$args['field']}";

        $this->binds = [
            $args['field'] => $args['value']
        ];

        return $this;

    }

    private function whereArgs($num_args,$args){

        if($num_args < 2){
            throw new \Exception("Opa, algo de errado aconteceu, o where precisa de no mínimo 2 argumentos");
        }
        
        if($num_args == 2){
            $field = $args[0];
            $sinal = '=';
            $value = $args[1];
        }
        
        if($num_args == 3){
            $field = $args[0];
            $sinal = $args[1];
            $value = $args[2]; 
        }
        
        if($num_args > 3){
            throw new \Exception("Opa, algo de errado aconteceu, o where não pode ter mais que 3 argumentos");
        }

        return [
            'field' => $field,
            'sinal' => $sinal,
            'value' => $value
        ];
    }

    public function get(){
        $select = $this->bindAndExecute();

        return $select->fetchAll();
    }

    public function first(){
       $select = $this->bindAndExecute();

       return $select->fetch();
    }

    private function bindAndExecute(){
        $select = $this->connect->prepare($this->sql);
        $select->execute($this->binds);

        return $select;
    }

}