<?php

use App\Models\Room;
use App\Models\User;
use App\Models\RoomType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(RoomType::class)->constrained();
            $table->foreignIdFor(Room::class)->constrained();
            $table->string('room_type');
            $table->string('room_name');
            $table->string('status');
            $table->timestamp('check_in')->nullable();
            $table->timestamp('check_out')->nullable();

            $table->softDeletes();
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
