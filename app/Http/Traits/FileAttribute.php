<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait FileAttribute
{
    public function getImage(string $path, string $attribute, string $placeholder='100x100')
    {
        $img = "http://placehold.it/$placeholder";

        $filesystem = config('filesystems.default');

        if (Storage::disk($filesystem)->exists('uploads/'.$path.'/'.$this->attributes[$attribute])) {
            $img = Storage::disk($filesystem)->url('uploads/'.$path.'/'.$this->attributes[$attribute]);
        }

        return $img;
    }

}