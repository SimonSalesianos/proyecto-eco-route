<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Challenge::all();
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'difficulty' => 'integer|min:1|max:5',
            'points_reward' => 'integer|min:0',
            'co2_saving_estimate' => 'nullable|numeric|min:0',
            'target_participants' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        return Challenge::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Challenge $challenge)
    {
        return $challenge;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Challenge $challenge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Challenge $challenge)
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'difficulty' => 'integer|min:1|max:5',
            'points_reward' => 'integer|min:0',
            'co2_saving_estimate' => 'nullable|numeric|min:0',
            'target_participants' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $challenge->update($validated);
        return $challenge;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Challenge $challenge)
    {
        $challenge->delete();
        return response()->json(null, 204);
    }
}
