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
        Schema::create('environmental_impacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('scope')->default('monthly');
            $table->year('year')->nullable();
            $table->unsignedTinyInteger('month')->nullable();
            $table->decimal('co2_emitted', 10, 2)->nullable();
            $table->decimal('co2_saved', 10, 2)->nullable();
            $table->decimal('distance_sustainable', 10, 2)->nullable();
            $table->unsignedInteger('trips_sustainable')->default(0);
            $table->float('sustainable_share', 5, 2)->nullable();
            $table->boolean('is_final')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('environmental_impacts');
    }
};
