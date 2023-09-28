<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class resultUploadRequest extends FormRequest
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
            'title' => 'required',
            'courseName' => 'required',
            'courseId' => 'required',
            'className' => 'required',
            'resultSheet' => 'file|mimetypes:application/pdf,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,text/plain,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document',


        ];
    }
}
