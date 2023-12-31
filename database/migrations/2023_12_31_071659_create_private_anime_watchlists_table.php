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
        Schema::create('private_anime_watchlists', function (Blueprint $table) {
            $table->foreignId('private_anime_id')->constrained();
            $table->foreignId('watchlist_id')->constrained();
            $table->timestamps();
            $table->primary(['private_anime_id', 'watchlist_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_anime_watchlists');
    }
};
