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
        Schema::create('commit', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->primary();
            $table->string('hash');
            $table->text('message');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('committer_id');
            $table->string('timestamp');

            $table->foreign('event_id')->references('id')->on('notified_event');
            $table->foreign('author_id')->references('id')->on('user');
            $table->foreign('committer_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commit');
    }
};
