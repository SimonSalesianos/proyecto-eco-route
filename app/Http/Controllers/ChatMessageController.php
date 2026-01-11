<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatMessageController extends Controller
{
    public function index()
    {
        return response()->json(ChatMessage::all(), 200);
    }

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

        $chatMessage = ChatMessage::create($validated);
        return response()->json($chatMessage, 201);
    }

    public function show(ChatMessage $chatMessage)
    {
        return response()->json($chatMessage, 200);
    }

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
        return response()->json($chatMessage, 200);
    }

    public function destroy(ChatMessage $chatMessage)
    {
        $chatMessage->delete();
        return response()->json(['message' => 'Chat message deleted successfully'], 200);
    }
}
