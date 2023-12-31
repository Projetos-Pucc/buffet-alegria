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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name_package', 255);
            $table->text('food_description');
            $table->text('beverages_description');
            /** $table->text('description') */
            $table->string('photo_1');
            $table->string('photo_2');
            $table->string('photo_3');
            $table->boolean('status');
            $table->float('price');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
