<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

class BookingDetail extends Component
{
    public ?Collection $bookings;

    public function mount()
    {
        $this->bookings = Booking::where('user_id',auth()->user()->id)
                                ->get();
    }

    public function render()
    {
        return view('livewire.booking-detail')->layout('layouts.app');
    }
}
