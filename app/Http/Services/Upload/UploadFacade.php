<?php

namespace App\Http\Services\Upload;

use Illuminate\Support\Facades\Facade;

class UploadFacade extends Facade
{
    protected static function getFacadeAccessor() 
    { 
        return 'upload'; 
    }

}