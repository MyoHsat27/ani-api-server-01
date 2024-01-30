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
        Schema::create('private_anime_genres', function (Blueprint $table) {
            $table->foreignId('private_genre_id')->constrained()->onDelete('cascade');
            $table->foreignId('private_anime_id')->constrained();
            $table->timestamps();
            $table->primary(['private_genre_id', 'private_anime_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_anime_genres');
    }
};
