<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
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

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_flagged' => 'boolean',
            'is_deleted' => 'boolean',
        ];
    }

    /**
     * Get the challenge that the chat message belongs to.
     */
    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    /**
     * Get the user that posted the chat message.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
