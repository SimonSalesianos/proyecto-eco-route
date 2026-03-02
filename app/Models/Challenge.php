<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'city',           // ← nuevo
        'start_date',
        'end_date',
        'difficulty',
        'points_reward',
        'co2_saving_estimate',
        'target_participants',
        'current_participants',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'start_date'          => 'date',
            'end_date'            => 'date',
            'co2_saving_estimate' => 'decimal:2',
            'is_active'           => 'boolean',
        ];
    }

    public function rewards()
    {
        return $this->hasMany(Reward::class);
    }

    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
    