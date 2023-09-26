<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRegistrationRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'number' => 'required',
            'degree' => 'required',
            'university' => 'required',
            'video_resume' => 'required|mimetypes:video/mp4',
            'photo' => 'required|image|max:2048',
            'cv' => 'required|mimes:pdf,ppt,doc,docx|max:2048',

        ];
    }
}
