<?php

namespace App\Http\Eloquent\Entities;

use App\Http\Traits\Author;
use App\Http\Traits\FileAttribute;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Album extends Model
{
    use FileAttribute, Sluggable, Author;

    const ACTIVE = 1;
    const INACTIVE = 0;

    protected $guarded = ['id'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', $this::ACTIVE);
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->getImage('album/thumbnail', 'thumbnail');
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
}
