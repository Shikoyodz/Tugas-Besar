<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\RoomType;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Collection;

class Discovery extends Component
{
    public ?Collection $rooms;

    public ?RoomType $roomType;

    public $selectedRoom;

    public function mount()
    {
        $this->rooms = RoomType::get();
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
        return view('livewire.discovery')->layout('layouts.app');
    }
}
