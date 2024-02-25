<?php

namespace App\Helpers;

use Image;

class SaveAsImage
{
    public $file;

    public $name;

    public function file($image)
    {
        $this->file = $image;

        return $this;
    }

    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    public function save()
    {
        $make = Image::make($this->file);

        $make->text('toram-id.com', 15, 30, function ($font) {
            $font->file(3);
            $font->size(34);
            $font->color('#ffffff');
        });

        $make->save(public_path($this->name));
    }
}
