<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
{
    // auth
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'body' => 'required|max:1000'
        ];
    }
}
