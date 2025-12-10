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
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('challenge_id')->nullable()->constrained('challenges')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->text('content');
            $table->boolean('is_flagged')->default(false);
            $table->boolean('is_deleted')->default(false);
            $table->text('moderation_notes')->nullable();
            $table->unsignedInteger('likes_count')->default(0);
            $table->unsignedInteger('reports_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};
