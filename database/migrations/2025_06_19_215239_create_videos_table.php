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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Course::class);
            $table->string('title');
            $table->text('description');
            $table->string('slug')->unique();
            $table->integer('duration_in_minutes')->nullable();
            $table->string('vimeo_id')->nullable();
            // $table->string('image')->nullable();
            // $table->json('learnings')->nullable();
            // $table->string('tagline')->nullable();
            // $table->timestamp('released_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
