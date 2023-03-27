<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Services\VehicleService;
use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function __construct(VehicleService $service)
    {
        $this->middleware('admin')->except(['index']);
        $this->service = $service;
    }

    public function index()
    {
        if(
            auth()->user()->role == 'superadmin' ||
            auth()->user()->role == 'admin'
        )
            return $this->service->index();
            
        return response()->json([
            'success' => false,
            'message' => 'invalid role access',
        ], 401);
    }

    public function show(string $id)
    {
        return $this->service->show($id);
    }

    public function store(VehicleRequest $request)
    {
        return $this->service->store($request);
    }

    public function update(VehicleRequest $request, string $id)
    {
        return $this->service->update($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->service->destroy($id);
    }
}