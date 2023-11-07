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
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->string('hash');
            $table->text('message');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('committer_id');
            $table->timestamp('timestamp')->useCurrent();

            $table->foreign('event_id')->references('id')->on('event');
            $table->foreign('author_id')->references('id')->on('user');
            $table->foreign('committer_id')->references('id')->on('user');

            $table->unique(['event_id', 'hash']);
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
