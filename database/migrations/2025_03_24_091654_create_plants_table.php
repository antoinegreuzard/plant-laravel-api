<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('variety')->nullable();
            $table->string('plant_type', 20);
            $table->date('purchase_date')->nullable();
            $table->string('location')->nullable();
            $table->text('description')->nullable();

            $table->integer('watering_frequency')->default(7);
            $table->integer('fertilizing_frequency')->default(30);
            $table->integer('repotting_frequency')->default(365);
            $table->integer('pruning_frequency')->default(90);

            $table->date('last_watering')->nullable();
            $table->date('last_fertilizing')->nullable();
            $table->date('last_repotting')->nullable();
            $table->date('last_pruning')->nullable();

            $table->string('sunlight_level', 10)->default('medium');
            $table->float('temperature')->nullable();
            $table->string('humidity_level', 10)->default('medium');

            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};
