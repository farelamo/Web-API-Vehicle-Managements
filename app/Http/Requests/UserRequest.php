<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'      => 'required|max:150',
            'phone'     => 'required|max:13',
            'age'       => 'required|numeric',
            'username'  => 'required|max:20',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'name must be filled',
            'name.max'          => 'maximal name is 150 character',
            'phone.required'    => 'phone must be filled',
            'phone.max'         => 'maximal phone is 13 character',
            'age.required'      => 'age must be filled',
            'age.numeric'       => 'age must be numeric',
            'username.required' => 'username must be filled',
            'username.max'      => 'maximal username is 20 character',
        ];
    }
}