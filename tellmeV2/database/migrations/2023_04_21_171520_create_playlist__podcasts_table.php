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
        Schema::create('playlist_podcasts', function (Blueprint $table) {
         
            $table->foreignId('podcast_id')
            ->constrained('podcasts')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        $table->foreignId('playlist_id')
            ->constrained('playlists')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        $table->primary(['podcast_id', 'playlist_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playlist__podcasts');
    }
};
