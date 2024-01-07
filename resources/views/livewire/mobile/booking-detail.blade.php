<div class="px-4"> 
    <div class="overflow-auto h-screen flex flex-col gap-4">
        @foreach ($bookings as $booking)
            <div class="bg-white shadow-md border w-full rounded-lg h-20">
                <div class="flex">
                    <img class="w-20 h-20 rounded-l-md" src="{{$booking->type->getFirstMediaUrl('preview')}}">
                    <div class="py-1 flex flex-col gap-2 grow px-4">
                        <div class="flex flex-col">
                            <span class="font-normal text-sm">{{$booking->room_type}} - ({{$booking->room_name}})</span>
                            <span class="text-xs text-gray-600">{{
                                \Carbon\Carbon::parse($booking->check_in)->format('d M Y')
                            . ' - ' . 
                                \Carbon\Carbon::parse($booking->check_out)->format('d M Y')
                            }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-normal">
                                {{money($booking->billingDetail->total,'IDR')}}
                            </span>
                            <span class="text-xs">
                                {{$booking->status}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>