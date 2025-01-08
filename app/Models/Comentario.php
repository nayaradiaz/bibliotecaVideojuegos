<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Comentario extends Model
{
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('videojuego_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('puntuacion')->min(1)->max(5);
            $table->text('comentario')->nullable();
            $table->timestamps();
        });
    }
    public function videojuego()
    {
        return $this->belongsTo(Videojuego::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
