<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('videogame_id')->constrained()->onDelete('cascade');
            $table->integer('punctuation');
            $table->text('comment')->nullable();
            $table->timestamps();

            // Restricción para que un usuario solo pueda valorar una vez por videojuego
            $table->unique(['user_id', 'videogame_id']);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
