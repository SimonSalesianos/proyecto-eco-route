<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'category',
        'start_date',
        'end_date',
        'difficulty',
        'points_reward',
        'co2_saving_estimate',
        'target_participants',
        'current_participants',
        'is_active',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'co2_saving_estimate' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the rewards for the challenge.
     */
    public function rewards()
    {
        return $this->hasMany(Reward::class);
    }

    /**
     * Get the chat messages for the challenge.
     */
    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
