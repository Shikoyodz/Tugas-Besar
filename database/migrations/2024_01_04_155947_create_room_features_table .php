<?php

use App\Models\Room;
use App\Models\Feature;
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
        Schema::create('room_type_features', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(RoomType::class)->constrained();
            $table->foreignIdFor(Feature::class)->constrained();
            $table->integer('qty');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('features');
    }
};
