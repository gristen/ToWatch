<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->integer('kinopoisk_id');
            $table->string('name')->nullable();
            $table->string('eng_name')->nullable();
            $table->string('type');
            $table->enum('status', ['announced', 'completed', 'filming', 'post-production', 'pre-production'])->nullable();
            $table->string("route_to_film");
            $table->string('slug')->unique()->after('name');
            $table->string("preview_url");
            $table->integer("movieLength")->nullable();
            $table->integer("age_rating")->nullable();;
            $table->text("description")->nullable();
            $table->string("shortDescription")->nullable();
            $table->string("preview");
            $table->year('year');

            $table->foreignId('user_published')->constrained('users');

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
