<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistoryRequest;
use App\Services\HistoryService;
use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{
    public function __construct(HistoryService $service)
    {
        $this->middleware('admin')->except(['index', 'spvAdminGet', 'spvAdminApprove', 'spvEmployeeGet', 'spvEmployeeApprove']);
        $this->middleware('spv.admin')->only(['spvAdminApprove', 'spvAdminGet']);
        $this->middleware('spv.employee')->only(['spvEmployeeApprove', 'spvEmployeeGet']);
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

    public function store(HistoryRequest $request)
    {
        return $this->service->store($request);
    }

    public function update(HistoryRequest $request, string $id)
    {
        return $this->service->update($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->service->destroy($id);
    }

    public function spvAdminGet()
    {
        return $this->service->spvAdminGet();
    }

    public function spvAdminApprove(string $id)
    {
        return $this->service->spvAdminApprove($id);
    }

    public function spvEmployeeGet()
    {
        return $this->service->spvEmployeeGet();
    }

    public function spvEmployeeApprove(string $id)
    {
        return $this->service->spvEmployeeApprove($id);
    }
}