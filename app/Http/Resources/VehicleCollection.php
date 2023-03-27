<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VehicleCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'data'    => $this->collection->transform(function ($data) {
                return [
                    'id'                => $data->id,
                    'name'              => $data->name,
                    'type'              => $data->type,
                    'schedule_service'  => $data->schedule_service,
                ];
            })
        ];
    }
}