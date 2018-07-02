<?php
namespace App\traits;

trait Sanitize {

    protected function sanitize(){
        $sanitize = [];

        foreach ($_POST as $field => $value) {
            $sanitize[$field] = filter_var($value, FILTER_SANITIZE_STRING);
        }

        return $sanitize;
    }

}