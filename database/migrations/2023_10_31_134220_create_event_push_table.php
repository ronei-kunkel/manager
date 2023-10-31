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
        Schema::create('event_push', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->primary();
            $table->string('platform_hash');
            $table->unsignedBigInteger('repository_id');
            $table->unsignedBigInteger('merger_id')->nullable();
            $table->string('target_branch');

            $table->foreign('event_id')->references('id')->on('event');
            $table->foreign('platform_hash')->references('hash')->on('platform');
            $table->foreign('merger_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_push');
    }
};
