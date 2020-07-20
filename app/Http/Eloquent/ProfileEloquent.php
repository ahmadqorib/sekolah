<?php

namespace App\Http\Eloquent;

use App\Http\Eloquent\Entities\Profile;

class ProfileEloquent {

    public function getFirst()
    {
        return Profile::first();
    }

    public function store(array $data)
    {
        return Profile::create($data);
    }

    public function update(array $data)
    {
        $profile = Profile::first();

        return $profile->update($data);
    }

}