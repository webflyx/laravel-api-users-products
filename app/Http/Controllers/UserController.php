<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'first_name', 'last_name')->with([
            'products' => function ($query) {
                $query->select('id', 'title', 'description');
            }
        ])->get();
        
        return UserResource::collection($users);
    }

    public function store(UserRequest $request)
    {
        $userService = new UserService();
        $userService->create($request->validated());

        return response('User successfully created', 200);
    }

    public function show(User $user)
    {
        return new UserResource($user->load('products'));
    }

    public function update(UserRequest $request, User $user)
    {
        $userService = new UserService();
        $userService->update($user, $request->validated());

        return response('User successfully updated', 200);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response(status: 204);
    }
}
