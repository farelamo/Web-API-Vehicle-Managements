<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class HistoryCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'data'    => $this->collection->transform(function ($data) {
                return [
                    'id'                    => $data->id,
                    'start_date'            => $data->start_date,
                    'end_date'              => $data->end_date,
                    'fuel'                  => $data->fuel,
                    'distance'              => $data->distance,
                    'description'           => $data->description,
                    'spv_admin_approve'     => $data->spv_admin_approve,
                    'spv_employee_approve'  => $data->spv_employee_approve,
                    'vehicle'               => [
                                                'id'   => $data->vehicle->id,
                                                'name' => $data->vehicle->name
                                            ],
                    'employee'              => [
                                                'id'   => $data->employee->id,
                                                'name' => $data->employee->name
                                            ],
                    'admin'                 => [
                                                'id'   => $data->admin->id,
                                                'name' => $data->admin->name
                                            ],
                    'spv_employee'          => [
                                                'id'   => $data->spv_employee->id ?? null,
                                                'name' => $data->spv_employee->name ?? null
                                            ],
                    'spv_admin'             => [
                                                'id'   => $data->spv_admin->id ?? null,
                                                'name' => $data->spv_admin->name ?? null
                                            ],
                ];
            })
        ];
    }
}