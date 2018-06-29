<?php
namespace App\Core;
use App\traits\Validations;

class Validate {
    use Validations;

    public function validate($rules){
        foreach ($rules as $field => $validation) {
            if($this->hasOneValidation($validation)){
                $this->$validation($field);
            }
            if($this->hasTworMoreValidation($validation)){
                $validations = explode(':', $validation);
                foreach ($validations as $validation) {
                    $this->$validation($field);
                }
            }
        }
    }

    private function hasOneValidation($validate){
        return substr_count($validate, ':') == 0 ;
    }

    private function hasTworMoreValidation($validate){
        return substr_count($validate, ':') >= 1 ;
    }
}