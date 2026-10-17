<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\Task\CreateRequest;
use App\Http\Requests\Task\UpdateRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Task::class);

        $user = Auth::user();

        if($user->role === 'admin'){
            $tasks = Task::with(["category","period"])->get()->groupBy('period_id');
        } else {
            $tasks = Task::where('user_id', $user->id)->with(["category", "period"])->get()->groupBy('period_id');
        }

        return response()->json([
            'success' => true,
            'message' => 'Tasks retrieved successfully',
            'data' => $tasks,
        ]);
    }

    public function store(CreateRequest $request)
    {
        Gate::authorize('create',Task::class);

        $task = Task::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Task created successfully',
            'data' => $task,
        ], 201);
    }

    public function update(UpdateRequest $request, Task $task)
    {
        Gate::authorize('update', $task);

        $task->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully',
            'data' => $task,
        ]);
    }

    public function destroy(Task $task)
    {
        Gate::authorize('delete', $task);

        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully',
            'data' => null,
        ]);
    }
}
