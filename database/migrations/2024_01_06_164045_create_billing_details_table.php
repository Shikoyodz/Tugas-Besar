<?php

use App\Models\Booking;
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
        Schema::create('billing_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Booking::class)->constrained();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('card_number');
            $table->string('vcc');
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
        Schema::dropIfExists('billing_details');
    }
};
