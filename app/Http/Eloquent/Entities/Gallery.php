<?php

namespace App\Http\Eloquent\Entities;

use App\Http\Traits\FileAttribute;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use FileAttribute;

    protected $guarded = ['id'];

    public function getImageUrlAttribute()
    {
        return $this->getImage('album/gallery', 'image');
    }
}
