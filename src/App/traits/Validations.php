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
        if(!filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)){
            $this->errors[$field][] = flash($field, error('Esse campo tem que ter um e-mail válido.'));
        }
    }

    protected function unique($field, $model){
        $model = "App\\Model\\".ucfirst($model);

        $model = new $model;

        $find = $model->find($field, $_POST[$field]);
        if($find and !empty($_POST[$field])){
            $this->errors[$field][] = flash($field, error('Esse valor já está cadastrado no banco de dados.'));
        }
    }

    protected function max($field, $max){
        if(strlen($_POST[$field]) > $max){
            $this->errors[$field][] = flash($field, error("O número de caracteres para esse campo não pode ser maior que $max."));
        }
    }
    
    protected function phone($field){
        if(!preg_match("/\([0-9]{2}\)[0-9]{5}\-[0-9]{4}/", $_POST[$field])){
            $this->errors[$field][] = flash($field, error('Formato inválido de telefone (xx)xxxxx-xxxx.'));
        }       
    }

    public function hasErrors(){
        return !empty($this->errors);
    }
}