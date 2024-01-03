<?php

use App\Enums\BookingStatus;
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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name_birthdayperson', 255);
            $table->string('years_birthdayperson', 255);
            $table->integer('qnt_invited'); 
            $table->date('party_day', 0);
            $table->foreignId('open_schedule_id')->constrained(
                table: 'open_schedules', indexName: 'bookings_open_schedule_id'
            );
            $table->enum('status', array_column(BookingStatus::cases(), 'name'));
            $table->foreignId('user_id')->constrained(
                table: 'users', indexName: 'bookings_user_id'
            );
            $table->foreignId('package_id')->constrained(
                table: 'packages', indexName: 'bookings_package_id'
            );
            $table->foreignId('decoration_id')->constrained(
                table: 'decorations', indexName: 'bookings_decoration-id'
            );
            $table->float('price'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
