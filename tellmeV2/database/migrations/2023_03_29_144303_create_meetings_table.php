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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('launcher_id')
                ->constrained('users')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('receiver_id')
                ->constrained('users')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('ender_id')
                ->constrained('users')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('ended_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
