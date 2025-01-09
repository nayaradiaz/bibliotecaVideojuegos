<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Videogame extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'cover',
    ];
    public function up()
    {
        Schema::create('videogames', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('cover')->nullable();
            $table->timestamps();
        });
    }
}
