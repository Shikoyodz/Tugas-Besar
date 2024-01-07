<?php

use App\Models\Booking;
use App\Models\Accomodation;
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
        Schema::table('accomodations', function (Blueprint $table) {
            $table->decimal('price',11,2);
        });

        Schema::create('booking_accomodations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Booking::class)->constrained();
            $table->foreignIdFor(Accomodation::class)->constrained();
            $table->integer('qty');
            $table->decimal('total',11,2);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accomodations', function (Blueprint $table) {
            $table->dropColumn('price');
        });

        Schema::dropIfExists('booking_accomodations');
    }
};
