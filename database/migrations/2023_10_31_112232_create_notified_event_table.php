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
        Schema::create('notified_event', function (Blueprint $table) {
            $table->id();
            $table->string('hash');
            $table->string('platform_hash');

            $table->foreign('platform_hash')->references('hash')->on('platform');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notified_event');
    }
};
