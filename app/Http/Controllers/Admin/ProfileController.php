<?php

namespace App\Http\Controllers\Admin;

use Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Eloquent\ProfileEloquent;

class ProfileController extends Controller
{
    protected $profile;

    public function __construct(ProfileEloquent $profile)
    {
        $this->profile = $profile;
    }

    public function index()
    {
        $profile = $this->profile->getFirst();

        return view('admin.profile.index', compact('profile'));
    }

    public function create()
    {
        return view('admin.profile.create');
    }

    public function store(ProfileRequest $request)
    {
        $data = $request->data();
        try {
            if($request->has('logo')){
                $fileName = Upload::from($request->file('logo'))
                ->to('profile/logo')
                ->type('image')
                ->generateNameByFile()
                ->return();

                $data['logo'] = $fileName;
            }

            $save = $this->profile->store($data);

            if($save){
                notice('success', 'Data berhasil disimpan');
            }
        }catch(Exception $e) {
            notice('error', 'Mohon maaf, terjadi kesalahan');
        }

        return redirect()->route('admin.profile.index');
    }

    public function edit()
    {
        $profile = $this->profile->getFirst();
        return view('admin.profile.create', compact('profile'));
    }

    public function update(ProfileRequest $request)
    {
        $data = $request->data();
        try {
            if($request->has('logo')){
                $fileName = Upload::from($request->file('logo'))
                ->to('profile/logo')
                ->type('image')
                ->generateNameByFile()
                ->return();

                $data['logo'] = $fileName;
            }

            $save = $this->profile->update($data);

            if($save){
                notice('success', 'Data berhasil diperbaharui');
            }
        }catch(Exception $e) {
            notice('error', 'Mohon maaf, terjadi kesalahan');
        }

        return redirect()->route('admin.profile.index');
    }
}
