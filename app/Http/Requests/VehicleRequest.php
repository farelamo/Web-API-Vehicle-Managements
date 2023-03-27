<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'              => 'required|max:150',
            'type'              => 'required|in:people,goods',
            'schedule_service'  => 'required|date|date_format:Y-m-d'
        ];
    }

    public function messages()
    {
        return [
            'name.required'                 => 'vehicle name must be filled',
            'name.max'                      => 'maximal vehicle name is 150 character',
            'type.required'                 => 'vehicle type must be filled',
            'type.in'                       => 'no type found in vehicle type',
            'schedule_service.required'     => 'schedule service must be filled',
            'schedule_service.date'         => 'schedule service must be filled',
            'schedule_service.date_format'  => 'schedule service must be filled',
        ];
    }
}