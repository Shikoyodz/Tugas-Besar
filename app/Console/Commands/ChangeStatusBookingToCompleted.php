<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Illuminate\Console\Command;
use App\Enums\BookingStatusEnum;

class ChangeStatusBookingToCompleted extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:change-status-booking-to-completed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Booking::where('status',BookingStatusEnum::Active->value)
                ->whereDate('check_out','<',now())
                ->each(function($booking){
                    $booking->update([
                        'status' => BookingStatusEnum::Completed->value
                    ]);
                });
    }
}
