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
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('challenge_id')->nullable()->constrained('challenges')->cascadeOnDelete();

            $table->string('name');
            $table->text('description')->nullable();
            $table->string('partner')->nullable();
            $table->unsignedInteger('points_cost')->default(0);
            $table->unsignedInteger('stock')->nullable();
            $table->boolean('is_active')->default(true);
            $table->decimal('estimated_value', 8, 2)->nullable();
            $table->date('valid_from')->nullable();
            $table->date('valid_until')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rewards');
    }
};
