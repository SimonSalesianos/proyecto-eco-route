<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index()
    {
        return response()->json(Reward::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'challenge_id' => 'nullable|exists:challenges,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'partner' => 'nullable|string|max:255',
            'points_cost' => 'required|integer|min:0',
            'stock' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'estimated_value' => 'nullable|numeric|min:0',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after_or_equal:valid_from',
        ]);

        $reward = Reward::create($validated);
        return response()->json($reward, 201);
    }

    public function show(Reward $reward)
    {
        return response()->json($reward, 200);
    }

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
            'valid_until' => 'nullable|date|after_or_equal:valid_from',
        ]);

        $reward->update($validated);
        return response()->json($reward, 200);
    }

    public function destroy(Reward $reward)
    {
        $reward->delete();
        return response()->json(['message' => 'Reward deleted successfully'], 200);
    }
}
