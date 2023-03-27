<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|max:150',
            'phone'    => 'required|max:13',
            'age'      => 'required|numeric',
            'address'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => 'employee name must be filled',
            'name.max'         => 'maximal employee name is 150 character',
            'phone.required'   => 'employee phone must be filled',
            'phone.max'        => 'maximal employee phone is 13 character',
            'age.required'     => 'employee age must be filled',
            'age.numeric'      => 'employee age must be numeric',
            'address.required' => 'employee address must be filled',
        ];
    }
}