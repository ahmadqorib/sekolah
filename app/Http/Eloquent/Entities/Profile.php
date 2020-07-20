<?php

namespace App\Http\Eloquent\Entities;

use App\Http\Traits\FileAttribute;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use FileAttribute;

    protected $guarded = ['id'];

    public function getLogoUrlAttribute()
    {
        return $this->getImage('profile/logo', 'logo');
    }
}
