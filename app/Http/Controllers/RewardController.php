<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Reward::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'challenge_id' => 'nullable|exists:challenges,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'partner' => 'nullable|string|max:255',
            'points_cost' => 'integer|min:0',
            'stock' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'estimated_value' => 'nullable|numeric|min:0',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date',
        ]);

        return Reward::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reward $reward)
    {
        return $reward;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reward $reward)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reward $reward)
    {
        $validated = $request->validate([
            'challenge_id' => 'nullable|exists:challenges,id',
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'partner' => 'nullable|string|max:255',
            'points_cost' => 'integer|min:0',
            'stock' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'estimated_value' => 'nullable|numeric|min:0',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date',
        ]);

        $reward->update($validated);
        return $reward;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reward $reward)
    {
        $reward->delete();
        return response()->json(null, 204);
    }
}
