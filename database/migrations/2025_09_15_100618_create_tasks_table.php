<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->enum('urgency', ['low', 'medium', 'high'])->default('medium');
            $table->enum('difficulty', ['low', 'medium', 'high'])->default('medium');
            $table->enum('completed', ['0', '1'])->default('0');
            $table->string('link_git')->nullable();
            $table->string('comment')->nullable();

            $table->foreignId('user_id')->constrained('users');

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('task');
    }
};
