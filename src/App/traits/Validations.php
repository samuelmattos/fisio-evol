<?php
namespace App\traits;

trait Validations {

    private $errors = [];

    protected function required($field){
        if(empty($_POST[$field])){
            $this->errors[$field][] = flash($field, error('Esse campo é obrigatório.'));
        }
    }
    protected function email($field){

    }
    protected function unique($field){

    }
    protected function phone($field){
        if(empty($_POST[$field])){
            $this->errors[$field][] = flash($field, error('Esse campo é obrigatório.'));
        }
    }

    public function hasErrors(){
        return !empty($this->errors);
    }
}