<?php 

namespace App\Http\Traits;

trait Author {
    protected static function boot()
    {
        self::creating(function($model){
            $model->created_by = auth()->user()->id ?? null;
        });

        self::updating(function($model){
            $model->updated_by = auth()->user()->id ?? null;
        });

        self::deleting(function($model){
            $model->deleted_by = auth()->user()->id;
            $model->save();
        });

        parent::boot();
    }
}