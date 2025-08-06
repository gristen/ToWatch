<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('eng_name');
            $table->string('type');
            $table->string("route_to_film");
            $table->string("preview_url");
            $table->integer("movieLength");
            $table->integer("age_rating");
            $table->string("description");
            $table->string("shortDescription")->nullable();
            $table->string("preview");
            $table->date('year');

            $table->foreignId('user_published')->constrained('users');
            $table->foreignId('genres_id')->constrained('genres');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
