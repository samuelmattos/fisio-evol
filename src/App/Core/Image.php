<?php

namespace App\Core;

use Intervention\Image\ImageManager;

class Image
{
    private $intervention;
    private $image;
    private $rename;
    private $resized = false;
    
    public function __construct($imageName)
    {
        $this->intervention = new ImageManager;
        $this->image = $_FILES[$imageName];
    }

    private function rename()
    {
        $extension = pathinfo($this->image['name'], PATHINFO_EXTENSION);
        $this->rename = md5(uniqid()).time().".{$extension}";
    }

    public function getName()
    {
        return $this->rename;
    }

    public function size($type)
    {
        $size = $this->type($type);
        $target = getimagesize($this->image['tmp_name']);
        $percent = ($target[0] > $target[1]) ? ($size/ $target[0]) : ($size/$target[1]);

        $resizeWidth= round($target[0] * $percent);
        $resizeHeigth= round($target[1] * $percent);

        $this->type = $type;

        $this->resized = true;

        return $this;
    }

    private function type($type)
    {
        switch ($type) {
            case 'user':
            $size = 200;
                break;            
            default:
            $size = 450;
                break;
        }

        return $size;
    }

    private function doUpload()
    {
        if(!$this->resized){
            throw new Exception("Chame o método size, para redimensionar sua foto.");
        }
    }

    public function upload()
    {

    }
}