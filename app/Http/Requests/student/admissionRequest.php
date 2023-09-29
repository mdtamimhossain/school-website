<?php

namespace App\Http\Requests\student;

use Illuminate\Foundation\Http\FormRequest;

class admissionRequest extends FormRequest
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
            'birthdate' => 'required',
            'fName' => 'required',
            'mName' => 'required',
            'address' => 'required',
            'number'=>'required',
            'age'=>'required',
            'gender'=>'required',
            'intendedClass'=>'required'
        ];
    }
}
