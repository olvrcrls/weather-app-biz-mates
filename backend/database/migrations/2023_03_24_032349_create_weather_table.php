<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weathers', function (Blueprint $table) {
            $table->id();
            $table->string('city'); // This should be a city ID but we will make it simpler.
            $table->foreignId('user_id')->index();
            // Temperatures are stored in Kelvin.
            $table->decimal('temperature', 6, 2);
            $table->decimal('max_temperature', 6, 2);
            $table->decimal('min_temperature', 6, 2);
            $table->string('title');
            $table->text('description');
            $table->integer('humidity_percentage')->nullable();
            $table->string('feels_like_temperature')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weathers');
    }
};
