<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;
use App\Models\RoomType;
use App\Enums\BookingStatusEnum;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;

class Home extends Component
{
    public ?Collection $featured_rooms;

    public ?Collection $top_rooms;

    public ?RoomType $roomType;

    public $selectedRoom;

    public function mount()
    {
        $this->featured_rooms = RoomType::get();

        $top_booking_room_ids = Booking::select('room_type_id', DB::raw('COUNT(*) as total_completed_bookings'))
                                    ->where('status', BookingStatusEnum::Completed->value)
                                    ->groupBy('room_type_id')
                                    ->orderByDesc('total_completed_bookings')
                                    ->get('room_type_id')
                                    ->map(fn($item) => $item->room_type_id)
                                    ->toArray();

        if(!empty($top_booking_room_ids))
        {
            $this->top_rooms = RoomType::whereIn('id',$top_booking_room_ids)
                                    ->get()
                                    ->sortBy(function ($roomType) use ($top_booking_room_ids) {
                                        return array_search($roomType->id, $top_booking_room_ids);
                                    });
        }else{
            $this->top_rooms = $this->featured_rooms;
        }
    }

    public function getRoomType(string $room_type_id)
    {
        try{
            if(!auth()->check())
            {
                return redirect()->to(route('login'));
            }
            
            $this->roomType = RoomType::findOrFail($room_type_id);
        }catch(\Exception $e)
        {
            Notification::make()
                ->danger()
                ->title('Failed Get Room Type')
                ->send();
        }
    }

    public function booking()
    {
        try{
            if(empty($this->selectedRoom))
            {
                throw new \Exception('Please Select Room !');
            }

            $data = explode('@',$this->selectedRoom);

            return redirect()->to(route('booking',[
                'roomType' => data_get($data,0),
                'room' => data_get($data,1)
            ]));
        }catch(\Exception $e)
        {
            Notification::make()
            ->title('Booking Failed!')
            ->body($e->getMessage())
            ->danger()
            ->send();
        }
    }

    public function resetRoom()
    {
        $this->dispatch('reset');
    }

    public function render()
    {
        return view('livewire.home')->layout('layouts.app');
    }
}
