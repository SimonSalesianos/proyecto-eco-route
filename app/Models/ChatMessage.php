<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = [
        'challenge_id',
        'user_id',
        'content',      
        'is_flagged',
        'is_deleted',
        'moderation_notes',
        'likes_count',
        'reports_count',
    ];

    protected function casts(): array
    {
        return [
            'is_flagged' => 'boolean',
            'is_deleted' => 'boolean',
        ];
    }

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
