<?php

namespace App\Http\Services\Upload;

use Illuminate\Http\UploadedFile;
use Storage;
use Image;

class UploadService
{
    private $uploadLocation;

    private $fileName;

    private $file;

    private $type;

    private $storageDriver;

    private $crop = false;

    public function __construct()
    {
        $this->storageDriver = config('filesystems.default');
    }

    public function from(UploadedFile $file): self
    {
        $this->file = $file;
        return $this;
    }

    public function to(string $location): self
    {
        $this->uploadLocation = $location;
        return $this;
    }

    public function type(string ...$type): self
    {
        $this->type = $type;
        return $this;
    }

    public function cropImage(int $width, int $height, int $x, int $y): self
    {
        $img = Image::make($this->file);
        $img->crop($width, $height, $x, $y);
        $this->crop = $img->encode();
        return $this;
    }

    public function generateName(string $name = null): self
    {
        if(is_null($name)){
            $name = $this->file->getClientOriginalName();
        }

        $path = 'uploads/'.$this->uploadLocation.'/'.$name.'.'.$this->getExtension();
        $exists = Storage::disk($this->storageDriver)->exists($path);

        if (! $exists) {
            $this->fileName = $name.'.'.$this->getExtension();
        } else {
            $i = 2;
            while(Storage::disk($this->storageDriver)->exists(
                'uploads/'.$this->uploadLocation.'/'.$name.'_'.$i.'.'.$this->getExtension())
            ) $i++;
            $this->fileName = $name.'_'.$i.'.'.$this->getExtension();
        }

        return $this;
    }

    public function generateNameByFile(): self
    {
        $name = $this->file->getClientOriginalName();
        $path = 'uploads/'.$this->uploadLocation.'/'.$name;
        $exists = Storage::disk($this->storageDriver)->exists($path);

        if(strpos($name, '.'.$this->getExtension()) !== false){
            $name = str_replace('.'.$this->getExtension(), '', $name);
        }

        if (! $exists) {
            $this->fileName = $name.'.'.$this->getExtension();
        } else {
            $i = 2;
            while(Storage::disk($this->storageDriver)->exists(
                'uploads/'.$this->uploadLocation.'/'.$name.'_'.$i.'.'.$this->getExtension())
            ) $i++;
            $this->fileName = $name.'_'.$i.'.'.$this->getExtension();
        }

        return $this;
    }

    public function getExtension(): string
    {
        return $this->file->getClientOriginalExtension();
    }

    private function validate(): void
    {
        if (empty($this->type)) {
            throw new UploadException("Tipe upload tidak boleh kosong");
        }

        $imageMimes = 'jpg,jpeg,png';
        $documentMimes = 'pdf,doc,docx,xls,xlsx,ppt,pptx';

        $request = [
            'file' => $this->file
        ];

        $mimes = ${$this->type[0].'Mimes'};
        if (count($this->type) > 1) {
            unset($this->type[0]);
            foreach($this->type as $type) {
                if (! isset(${$type.'Mimes'})) {
                    throw new UploadException("Konfigurasi mime untuk ".$type.' tidak tersedia');
                }
                $mimes = $mimes.', '.${$type.'Mimes'};
            }
        }

        \Validator::make($request, [
            'file' => 'required|max:50000|mimes:'.$mimes // 'required|max:5000|mimes:'.$mimes
        ], [
            "mimes" => 'Format file harus ('.str_replace(',', ', ', $mimes).')'
        ])->validate();
    }

    public function return(string $type = null): string
    {
        $this->validate();
        
        if (is_null($this->fileName)) {
            $this->fileName = $this->file->getClientOriginalName();
        }

        if (!$this->crop){
            $path = Storage::putFileAs(
                'uploads/'.$this->uploadLocation,
                $this->file,
                $this->fileName
            );
    
            Storage::setVisibility($path, 'public');
        }else{
            $put = Storage::put(
                'uploads/'.$this->uploadLocation.'/'.$this->fileName,
                $this->crop
            );
            $path = 'uploads/'.$this->uploadLocation.'/'.$this->fileName;
        }

        if ($type == 'path') {
            return $path;
        } elseif ($type == 'extension') {
            return $this->getExtension();
        } else {
            return $this->fileName;
        }

    }
}
