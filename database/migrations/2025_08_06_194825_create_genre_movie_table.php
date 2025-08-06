<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Pivot table
     */
    public function up(): void
    {
        Schema::create('genre_movie', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->constrained('movies');
            $table->foreignId('user_id')->constrained('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genre_movie');
    }
};
