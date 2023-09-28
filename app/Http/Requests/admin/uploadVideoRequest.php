<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class uploadVideoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'caption' => 'required',
            'video' => 'required|mimetypes:video/mp4',

        ];
    }
}
