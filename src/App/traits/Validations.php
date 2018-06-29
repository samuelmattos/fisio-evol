<?php
namespace App\traits;

trait Validations {
    private $errors = [];
    protected function required($field){
        if(empty($_POST[$field])){
            $this->errors[$field][] = flash($field, error('Esse campo é obrigatório.'));
        }
    }
    protected function email(){

    }
    protected function unique(){

    }
    protected function phone(){

    }    
    public function hasErrors(){
        return !empty($this->erros);
    }
}