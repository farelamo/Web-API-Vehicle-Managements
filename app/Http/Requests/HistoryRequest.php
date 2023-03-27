<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'vehicle_id'       => 'required|exists:vehicles,id',
            'employee_id'      => 'required|exists:employees,id',
            'start_date'       => 'required|date|date_format:Y-m-d',
            'end_date'         => 'required|date|date_format:Y-m-d',
            'fuel'             => 'required|max:5',
            'distance'         => 'required',
            'description'      => 'required',
        ];
    }

    public function messages()
    {
        return [
            'vehicle_id.required'       => 'vehicle_id must be filled',
            'vehicle_id.exists'         => "vehicle doesn't exists",
            'employee_id.required'      => 'employee_id must be filled',
            'employee_id.exists'        => "employee doesn't exists",
            'fuel.required'             => 'fuel must be filled',
            'fuel.max'                  => 'maximal fuel is 5 character',
            'start_date.required'       => 'start_date must be filled',
            'start_date.date'           => 'start_date must be type of date',
            'start_date.date_format'    => 'invalid start_date format',
            'end_date.required'         => 'end_date must be filled',
            'end_date.date'             => 'end_date must be type of date',
            'end_date.date_format'      => 'invalid end_date format',
            'distance.required'         => 'distance must be filled',
            'description.required'      => 'description must be filled',
        ];
    }
}