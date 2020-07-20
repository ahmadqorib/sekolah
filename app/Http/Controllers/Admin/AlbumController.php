<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\DataTables\AlbumDataTable;
use App\Http\Requests\AlbumRequest;
use App\Http\Controllers\Controller;
use App\Http\Eloquent\AlbumEloquent;

class AlbumController extends Controller
{
    private $album;

    public function __construct(AlbumEloquent $album)
    {
        $this->album = $album;
    }

    public function index(AlbumDataTable $datatable)
    {
        return $datatable->render('admin.album.index');
    }

    public function create()
    {
        return view('admin.album.create');
    }

    public function store(AlbumRequest $request)
    {
        $data = $request->data();
        try {
            $save = $this->album->store($data);

            notice('success', 'Data berhasil disimpan');
            return redirect()->route('admin.album.show', $save->id);
        }catch(Exception $e) {
            notice('error', 'Mohon maaf, terjadi kesalahan');
        }

        return redirect()->route('admin.album.index');
    }

    public function show($id)
    {
        $album = $this->album->findOrFail($id);
        return view('admin.album.show', compact('album'));
    }

    public function edit($id)
    {
        $album = $this->album->findOrFail($id);
        return view('admin.album.edit', compact('album'));
    }

    public function update($id, AlbumRequest $request)
    {
        $data = $request->data();
        try {
            $save = $this->album->update($id, $data);

            notice('success', 'Data berhasil diperbaharui');
            
            return redirect()->route('admin.album.show', $save->id);
        }catch(Exception $e) {
            notice('error', 'Mohon maaf, terjadi kesalahan');
        }

        return redirect()->route('admin.album.index');
    }

    public function destroy($id)
    {
        try {
            $save = $this->album->destroy($id);

            notice('success', 'Data berhasil dihapus');
        }catch(Exception $e) {
            notice('error', 'Mohon maaf, terjadi kesalahan');
        }

        return redirect()->route('admin.album.index');
    }

    public function uploadImage($idAlbum, Request $request)
    {
        try {
            $upload = $this->album->uploadImage($idAlbum, $request->file('file'));
            return response()->json($upload);
        }catch(Exception $e) {
            notice('error', 'Mohon maaf, terjadi kesalahan');
        }
        return redirect()->back();
    }

    public function deleteImage($idGallery)
    {
        try {
            $delete = $this->album->deleteImage($idGallery);
            return response()->json(['deleted'=>true]);
        }catch(Exception $e) {
            notice('error', 'Mohon maaf, terjadi kesalahan');
        }
        return redirect()->back();
    }

    public function getImageGallery($idAlbum)
    {
        $album = $this->album->findOrFail($idAlbum);

        $data = [];
        foreach($album->galleries as $gallery){
            $data[] = [
                'id' => $gallery->id,
                'name' => $gallery->image,
                'size' => size_file($gallery->image, 'album/gallery'),
                'path' => $gallery->image_url
            ];
        }  
        
        return response()->json($data);
    }
}
