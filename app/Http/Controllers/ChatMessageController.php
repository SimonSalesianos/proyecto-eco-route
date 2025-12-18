<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ChatMessage::all();
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
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string',
            'is_flagged' => 'boolean',
            'is_deleted' => 'boolean',
            'moderation_notes' => 'nullable|string',
        ]);

        return ChatMessage::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(ChatMessage $chatMessage)
    {
        return $chatMessage;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChatMessage $chatMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChatMessage $chatMessage)
    {
        $validated = $request->validate([
            'challenge_id' => 'nullable|exists:challenges,id',
            'user_id' => 'exists:users,id',
            'content' => 'string',
            'is_flagged' => 'boolean',
            'is_deleted' => 'boolean',
            'moderation_notes' => 'nullable|string',
            'likes_count' => 'integer|min:0',
            'reports_count' => 'integer|min:0',
        ]);

        $chatMessage->update($validated);
        return $chatMessage;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChatMessage $chatMessage)
    {
        $chatMessage->delete();
        return response()->json(null, 204);
    }
}
