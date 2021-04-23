<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // Topic only update title
        return [
            'title' => 'required|max:100'
        ];
    }
}
