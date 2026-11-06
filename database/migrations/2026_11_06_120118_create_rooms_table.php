
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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number', 20)->unique();
            $table->string('room_class', 50);
            $table->string('bed_type', 50);
            $table->unsignedInteger('max_occupancy');
            $table->decimal('price_per_night', 10, 2);
            $table->enum('status', [
                'available',
                'unavailable',
                'maintenance'
            ])->default('available');
            $table->string('view_type', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
