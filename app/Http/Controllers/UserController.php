<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct(UserService $service)
    {
        $this->middleware('user');
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return $this->service->index($request);
    }

    public function show(string $id)
    {
        return $this->service->show($id);
    }

    public function store(UserRequest $request)
    {
        return $this->service->store($request);
    }

    public function update(UserRequest $request, string $id)
    {
        return $this->service->update($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->service->destroy($id);
    }
}