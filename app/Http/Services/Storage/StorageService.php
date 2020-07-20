<?php

namespace App\Http\Services\Storage;

use Illuminate\Http\UploadedFile;
use Storage;
use Image;

class StorageService {
    private $fileName, $path, $fileSystem;

    public function __construct(array $fileName, string $path)
    {
        $this->fileName = $fileName;
        $this->path = 'uploads/'.$path;
        $this->fileSystem = config('filesystems.default');
    }

    public function delete()
    {
        $file = [];
        foreach($this->fileName as $fileName){
            $file[] = $this->path."/".$fileName;
        }
        
        if(!empty($file))
            return Storage::disk($this->fileSystem)->delete($file);
        
        return false;
    }

    public function download()
    {

    }
}