<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'challenge_id',
        'name',
        'description',
        'partner',
        'points_cost',
        'stock',
        'is_active',
        'estimated_value',
        'valid_from',
        'valid_until',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'estimated_value' => 'decimal:2',
            'valid_from' => 'date',
            'valid_until' => 'date',
        ];
    }

    /**
     * Get the challenge that the reward belongs to.
     */
    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }
}
