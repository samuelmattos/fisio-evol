<?php

namespace App\Core;

use Intervention\Image\ImageManager;

class Image
{
    private $intervention;
    private $image;
    private $rename;
    private $resized = false;
    private $resizeWidth;
    private $resizeHeigth;

    public function __construct($imageName)
    {
        $this->intervention = new ImageManager;
        $this->image = $_FILES[$imageName];
    }

    private function rename()
    {
        $extension = pathinfo($this->image['name'], PATHINFO_EXTENSION);
        $this->rename = md5(uniqid()) . time() . ".{$extension}";
    }

    public function getName()
    {
        return $this->rename;
    }

    public function size($type)
    {
        $size = $this->type($type);
        $target = getimagesize($this->image['tmp_name']);
        $percent = ($target[0] > $target[1]) ? ($size / $target[0]) : ($size / $target[1]);

        $this->resizeWidth = round($target[0] * $percent);
        $this->resizeHeigth = round($target[1] * $percent);

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
        if (!$this->resized) {
            throw new Exception("Chame o método size, para redimensionar sua foto.");
        }

        $image = $this->intervention->make($this->image['tmp_name'])->resize($this->resizeWidth, $this->resizeHeigth, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        if ($this->type == 'user') {
            $backgroud = $this->intervention->canvas(150, 150);
            $backgroud->insert($image, 'center');
            $backgroud->save("Assets/img/photos/{$this->rename}");
        } else {
            $image->save("Assets/img/photos/{$this->rename}");
        }
    }

    public function upload()
    {
        $this->rename();
        $this->doUpload();
        return $this->rename;
    }
}
