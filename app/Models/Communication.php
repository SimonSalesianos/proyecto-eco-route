<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Communication extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'channel',
        'audience',
        'scheduled_at',
        'sent_at',
        'status',
        'sent_count',
        'opened_count',
        'clicked_count',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
            'sent_at' => 'datetime',
        ];
    }

    /**
     * Get the user that created the communication.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
