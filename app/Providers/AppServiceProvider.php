<?php

namespace App\Providers;

use App\Models\Room;
use App\Models\User;
use App\Models\Booking;
use App\Observers\RoomObserver;
use App\Observers\UserObserver;
use App\Observers\BookingObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        User::observe(UserObserver::class);
        Room::observe(RoomObserver::class);
        Booking::observe(BookingObserver::class);
    }
}
