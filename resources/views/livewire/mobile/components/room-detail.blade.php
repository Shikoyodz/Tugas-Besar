<div class="fixed w-screen z-50 h-screen inset-0 flex items-end justify-center">
    <div class="bg-white w-full px-5 py-2 max-w-sm h-[80%] z-50 rounded-t-lg overflow-auto">
        <div class="flex flex-col items-center gap-3">
            <div class="border-b-4 rounded-full h-2 w-20"></div>
            <img src="{{$roomType->getFirstMediaUrl('preview')}}" class="rounded-md h-44 w-full" alt="">
        </div>
        <div class="mt-4">
            {{-- Room Type Information --}}
            <div class="flex flex-col gap-0.5 border-b pb-8">
                <h1 class="font-normal text-lg">{{$roomType->name}}</h1>
                <div class="text-gray-600 text-xs">
                    <span>
                        {{$roomType->capacity}} Guest
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="text-sm">
                        {{money($roomType->price,'IDR')}} / Night
                    </div>
                    {{-- <div class="flex gap-1 items-center">
                        <span>
                            6/10
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                        </svg>                      
                    </div> --}}
                </div>
            </div>

            {{-- Room Feature --}}
            <div class="py-3 border-b">
                <h1 class="text-sm font-semibold mb-2">
                    Amenities
                </h1>
                <div class="flex gap-2 flex-wrap">
                    @foreach($roomType->roomTypeFeatures as $item)
                        <div class="text-xs bg-[#818fb4] text-[#f5e8c6] px-2 py-1.5 rounded-full font-semibold shadow-lg">
                            {{$item->feature->name . ' - (' .$item->qty.'x)'}}
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Room List --}}
            <div class="py-3">
                <h1 class="text-sm font-semibold mb-2">Rooms</h1>
                <form 
                x-data="{
                    selected: null,
                    selectRoom(room)
                    {
                        this.selected = room;
                    }
                }"
                @reset.window="selected = null"
                wire:submit.prevent="booking">
                    <div class="flex h-40 items-center flex-col-reverse">
                        <div class="flex-none w-full">
                            <button
                            type="submit" 
                            class="w-full text-sm font-semibold px-4 py-2 bg-[#435585] hover:bg-[#362f62] transition-all duration-150 ease-in-out rounded-md text-white">
                                Book Now
                            </button>
                        </div>
                        <div class="w-full grow grid grid-cols-6 gap-2 overflow-y-auto mb-4">
                            @foreach ($roomType->rooms->where('status',\App\Enums\RoomStatusEnum::Ready->value) as $room)
                                <div class="flex h-11">
                                    <input 
                                        type="radio" 
                                        id="room-{{$room->id}}" 
                                        value="{{$roomType->id . '@' . $room->id}}"
                                        wire:model="selectedRoom"
                                        name="room-selection" 
                                        class="hidden appearance-none h-6 w-6 border border-gray-300 rounded-md focus:outline-none"
                                        @click="selectRoom('room-{{$room->id}}')"
                                    />
                                    
                                    <label 
                                    for="room-{{$room->id}}" 
                                    :class="selected === 'room-{{$room->id}}' 
                                        ? 'bg-[#f5e8c6] text-[#362f62] shadow-xl' 
                                        : 'bg-white text-black'"
                                    class="cursor-pointer rounded-md p-2 border">
                                        {{$room->name}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div
    @click="openRoomDetail = false"
    wire:click="resetRoom"
    class="absolute cursor-pointer bg-black/50 h-screen w-screen"></div>
</div>>