<?php

use App\Enums\GuestStatus;
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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cpf');
            $table->integer('idade');
            $table->enum('status',array_column(GuestStatus::cases(),'name'));
            $table->foreIgnID('booking_id')->constrained(
                table:'bookings',indexName:'guests_bookings_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
