<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function __construct(EmployeeService $service)
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

    public function store(EmployeeRequest $request)
    {
        return $this->service->store($request);
    }

    public function update(EmployeeRequest $request, string $id)
    {
        return $this->service->update($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->service->destroy($id);
    }
}