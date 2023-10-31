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
        Schema::create('notification', function (Blueprint $table) {
            $table->id();
            $table->string('platform_hash');
            $table->unsignedBigInteger('repository_id');
            $table->timestamp('received_at')->useCurrent();

            $table->foreign('platform_hash')->references('hash')->on('platform');
            $table->foreign('repository_id')->references('id')->on('repository');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification');
    }
};
