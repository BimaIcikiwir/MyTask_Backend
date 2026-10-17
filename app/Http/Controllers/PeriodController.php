<?php

namespace App\Http\Controllers;

use App\Models\Period;
use Illuminate\Http\Request;
use App\Http\Requests\Period\CreateRequest;
use App\Http\Requests\Period\UpdateRequest;
use Illuminate\Support\Facades\Gate;

class PeriodController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Period::class);

        $periods = Period::all();

        return response()->json([
            'success' => true,
            'message' => 'Periods retrieved successfully',
            'data' => $periods,
        ]);
    }

    public function store(CreateRequest $request)
    {
        Gate::authorize('create', Period::class);

        $period = Period::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Period created successfully',
            'data' => $period,
        ], 201);
    }

    public function update(UpdateRequest $request, Period $period)
    {
        Gate::authorize('update',$period);

        $period->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Period updated successfully',
            'data' => $period,
        ]);
    }

    public function destroy(Period $period)
    {
        Gate::authorize('delete',$period);

        $period->delete();

        return response()->json([
            'success' => true,
            'message' => 'Period deleted successfully',
            'data' => null,
        ]);
    }
}
