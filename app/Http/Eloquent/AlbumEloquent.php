<?php

namespace App\Http\Eloquent;

use Upload;
use Storage;
use Illuminate\Support\Str;
use App\Http\Eloquent\Entities\Album;
use App\Http\Eloquent\Entities\Gallery;

class AlbumEloquent {

    public function store(array $data)
    {
        return Album::create($data);
    }

    public function findOrFail(int $id)
    {
        return Album::findOrFail($id);
    }

    public function update($id, $data)
    {
        $album = $this->findOrFail($id);
        $album->update($data);
        
        return $album;
    }

    public function destroy(int $id)
    {
        $album = Album::find($id);
        $albumThumbnail = $album->thumbnail;
        
        $delete = $album->delete();

        if($delete){
            (new \App\Http\Services\Storage\StorageService([$albumThumbnail], 'album/thumbnail'))->delete();
            $galleries = Gallery::where('album_id', $id)->get();
            $fileName = $galleries->pluck('image')->toArray();
            $deleteGallery = Gallery::where('album_id', $id)->delete();

            if($deleteGallery){
                (new \App\Http\Services\Storage\StorageService($fileName, 'album/gallery'))->delete();
            }
        }

        return $delete;
    }

    public function uploadImage($idAlbum, $image)
    {
        $fileName = Upload::from($image)
            ->to('album/gallery')
            ->type('image')
            ->generateName((string) Str::uuid())
            ->return();

        $data = [
            'album_id' => $idAlbum,
            'image' => $fileName,
        ];

        $save = Gallery::create($data);
        return [
            'id' => $save->id,
            'name' => $save->image
        ];
    }

    public function deleteImage($idGallery)
    {
        $galllery = Gallery::findOrFail($idGallery);
        $fileName = $galllery->image;

        $delete = Gallery::destroy($idGallery);
        if($delete){
            (new \App\Http\Services\Storage\StorageService([$fileName], 'album/gallery'))->delete();
        }

        return $delete;
    }

}