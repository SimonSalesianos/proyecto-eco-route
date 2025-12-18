<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnvironmentalImpact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'scope',
        'year',
        'month',
        'co2_emitted',
        'co2_saved',
        'distance_sustainable',
        'trips_sustainable',
        'sustainable_share',
        'is_final',
        'notes',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'co2_emitted' => 'decimal:2',
            'co2_saved' => 'decimal:2',
            'distance_sustainable' => 'decimal:2',
            'sustainable_share' => 'float',
            'is_final' => 'boolean',
        ];
    }

    /**
     * Get the user that the environmental impact belongs to.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
