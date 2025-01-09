<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Videogame extends Model
{
    public function up()
    {
        Schema::create('videogames', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('cover')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
