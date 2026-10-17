<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {   
        Gate::authorize('viewAny', User::class);

        $users = User::all();

        return response()->json([
            'success' => true,
            'message' => 'Users retrieved successfully',
            'data' => $users,
        ]);
    }

    public function store(CreateRequest $request)
    {
        Gate::authorize('create',User::class);

        $user = User::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user,
        ], 201);
    }

    public function update(UpdateRequest $request, User $user)
    {
        Gate::authorize('update',$user);

        $user->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user,
        ]);
    }

    public function destroy(User $user)
    {
        Gate::authorize('delete',$user);

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
            'data' => null,
        ]);
    }
}
