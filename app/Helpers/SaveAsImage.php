<?php

namespace App\Helpers;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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
        $manager = new ImageManager(new Driver());
        $image = $manager->read($this->file);

        $image->text('toram-id.space', 15, 30, function ($font) {
            $font->filename(3);
            $font->size(34); // Note: ignored for internal fonts, but kept for compatibility if changed to TTF later
            $font->color('#ffffff');
        });

        $image->save(public_path($this->name));
    }
}
