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
        Schema::create('private_manga_readlists', function (Blueprint $table) {
            $table->foreignId('private_manga_id')->constrained();
            $table->foreignId('readlist_id')->constrained();
            $table->timestamps();
            $table->primary(['private_manga_id', 'readlist_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_manga_readlists');
    }
};
