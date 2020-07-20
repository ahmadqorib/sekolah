<?php

namespace App\Http\Requests;

use Upload;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Request;

class AlbumRequest extends FormRequest
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
            'thumbnail' => 'required|mimes:jpeg,jpg,png'
        ];

        if($this->isMethod('PUT')) {
            $rules = [
                'name' => 'required',
                'thumbnail' => 'mimes:jpeg,jpg,png'
            ];
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
        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'is_active' => $this->has('status') ? 1:0,
        ];

        if($this->has('thumbnail')){
            $fileName = Upload::from($this->file('thumbnail'))
            ->to('album/thumbnail')
            ->type('image')
            ->cropImage($this->imgWidth, $this->imgHeight, $this->imgX1, $this->imgY1)
            ->generateNameByFile()
            ->return();
      
            $data['thumbnail'] = $fileName;
        }


        return $data;
    }
}
