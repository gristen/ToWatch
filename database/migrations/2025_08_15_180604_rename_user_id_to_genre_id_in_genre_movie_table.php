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
        Schema::table('genre_movie', function (Blueprint $table) {
            $table->renameColumn("user_id", "genre_id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
