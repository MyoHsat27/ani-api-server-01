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
        Schema::create('private_manga_read_statuses', function (Blueprint $table) {
            $table->id();
            $table->float("chapter");
            $table->foreignId('favourite_level_id')->nullable()->constrained();
            $table->foreignId('watch_status_id')->constrained();
            $table->foreignId('private_manga_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_manga_read_statuses');
    }
};
