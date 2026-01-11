<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index()
    {
        return response()->json(Challenge::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'difficulty' => 'required|integer|min:1|max:5',
            'points_reward' => 'required|integer|min:0',
            'co2_saving_estimate' => 'nullable|numeric|min:0',
            'target_participants' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $challenge = Challenge::create($validated);
        return response()->json($challenge, 201);
    }

    public function show(Challenge $challenge)
    {
        return response()->json($challenge, 200);
    }

    public function update(Request $request, Challenge $challenge)
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'difficulty' => 'integer|min:1|max:5',
            'points_reward' => 'integer|min:0',
            'co2_saving_estimate' => 'nullable|numeric|min:0',
            'target_participants' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $challenge->update($validated);
        return response()->json($challenge, 200);
    }

    public function destroy(Challenge $challenge)
    {
        $challenge->delete();
        return response()->json(['message' => 'Challenge deleted successfully'], 200);
    }
}
