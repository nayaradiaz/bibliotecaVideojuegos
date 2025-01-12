<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Comment extends Model
{
    protected $fillable = [
        'videogame_id',
        'user_id',
        'punctuation',
        'comment',
    ];

    public function videogame()
    {
        return $this->belongsTo(Videogame::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function setPunctuationAttribute($value)
    {
        $this->attributes['punctuation'] = max(1, min(5, $value)); // Asegura que la puntuación esté entre 1 y 5
    }
}
