<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Secuencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'url_pictograma_1',
        'url_pictograma_2',
    ];

    public function secuenciasUsuario()
    {
        return $this->belongsTo(Secuencia::class);
    }
}
