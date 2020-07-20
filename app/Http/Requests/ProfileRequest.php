<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required',
            'vision' => 'required',
            'mission' => 'required',
            'address' => 'required',
            'phone_number' => 'required|numeric',
            'email' => 'required',
        ];

        if($this->has('id')){
            $rules['logo'] = 'mimes:jpeg,jpg,png';
        }else{
            $rules['logo'] = 'required|mimes:jpeg,jpg,png';
        }

        return $rules;
    }

    public function withValidator($validator): void
    {
        if ($validator->fails()) {
            notice('error', 'Data gagal divalidasi');
        }
    }

    public function data(): array
    {
        return [
            'name' => $this->name,
            'vision' => $this->vision,
            'mission' => $this->mission,
            'profile' => $this->description,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'map' => $this->map
        ];
    }
}
