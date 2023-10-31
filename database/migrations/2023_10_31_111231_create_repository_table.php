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
        Schema::create('repository', function (Blueprint $table) {
            $table->id();
            $table->string('remote_id');
            $table->string('platform_hash');
            $table->unsignedBigInteger('owner_id');
            $table->string('name');
            $table->string('clone_url');
            $table->string('default_branch');
            $table->text('description');
            $table->timestamp('aditioned_at')->useCurrent();

            $table->foreign('platform_hash')->references('hash')->on('platform');
            $table->foreign('owner_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repository');
    }
};
