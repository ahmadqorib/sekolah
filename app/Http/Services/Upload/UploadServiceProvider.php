<?php

namespace App\Http\Services\Upload;

use Illuminate\Support\ServiceProvider;

class UploadServiceProvider extends ServiceProvider
{
    public function boot()
    {
        
    }

    public function register()
    {
        $this->app->bind('upload', function() {
            return new \App\Http\Services\Upload\UploadService;
        });
    }
}