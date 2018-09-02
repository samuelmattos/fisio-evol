<?php
namespace App\Templates;

class Template 
{
    public function run($data){
        $contents = file_get_contents("../emails/{$this->template}.php");
        $find = array();
        $replace = array();
        foreach ($data as $key => $value) {
            $find[] = "&#{$key}";
            $replace[] = $value;
        }
        return str_replace($find, $replace, $contents);
    }
}
