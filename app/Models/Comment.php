<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Comment extends Model
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('videogame_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('punctuation')->min(1)->max(5);
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }
    public function videogame()
    {
        return $this->belongsTo(Videogame::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
