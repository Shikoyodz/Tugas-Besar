<div 
x-data="{
    changeCalender : false,
    editAccomodation : false,
    proceedPayment : false,
    validationPayment : false
}"
@calender.window="changeCalender = false"
@accomodation.window="editAccomodation = false"
@payment.window="proceedPayment = false"
class="px-4">
    <div>
        <h1 class="text-2xl font-normal">
            {{$roomType->name}} ({{$room->name}})
        </h1>
        <span class="font-normal text-sm text-gray-600">
            {{$roomType->capacity}} Guest
        </span>
    </div>
    <div class="flex flex-col gap-2 mt-4">
        <h1 class="text-sm font-semibold">
            Date
        </h1>
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
            </svg>
            <span class="text-sm">
                {{$from . ' - ' . $to}}
            </span>  
            <span 
            @click="changeCalender = true"
            class="text-sm text-blue-500 cursor-pointer select-none"> 
                Change
            </span>  
        </div>
    </div>

    <div class="mt-4">
        <div class="flex items-center w-full justify-between">
            <h1 class="text-sm font-semibold">
                Accomodation
            </h1>
            <span 
            @click="editAccomodation = true"
            class="text-sm text-blue-500 cursor-pointer select-none">
                Edit
            </span>
        </div>
            
        @if (!empty($accomodation_data))
            <div class="mt-2 flex text-sm items-center justify-between">
                @foreach ($accomodation_data as $accomodation)
                    <span>
                        {{$accomodation['name']}}
                    </span>
                    <span>
                        {{$accomodation['qty']}}x
                    </span>
                    <span>
                        {{money($accomodation['total'],'IDR',true)}}
                    </span>
                @endforeach
            </div>
        @endif
    </div>

    <div class="mt-4">
        <h1 class="text-sm font-semibold">
            Payment
        </h1>
        <div class="mt-2 flex text-sm items-center justify-between">
            <span>
                Room {{"({$this->qty} Night)"}}
            </span>
            <span>
                {{money($room_total,'IDR',true)}}
            </span>
        </div>
        <div class="mt-2 flex text-sm items-center justify-between">
            <span>
                Accomodation
            </span>
            <span>
                {{money($accomodation_total,'IDR',true)}}
            </span>
        </div>
        <div class="mt-2 flex text-sm items-center justify-between">
            <span>
                Tax
            </span>
            <span>
                {{money($tax,'IDR',true)}}
            </span>
        </div>
        <div class="mt-2 font-semibold flex text-sm items-center justify-between">
            <span>
                Total
            </span>
            <span>
                {{money($total,'IDR',true)}}
            </span>
        </div>
    </div>

    <div class="mt-4">
        <h1 class="text-sm font-semibold">
            Payment Method
        </h1>
        <div class="grid grid-cols-4 gap-2 mt-2">
            @foreach($paymentMethods as $method)
                <img 
                class="border rounded-md h-11 w-full"
                src="{{$method->getFirstMediaUrl('logo')}}" alt="">
            @endforeach
        </div>
    </div>

    <button 
    @click="proceedPayment = true"
    class="bg-[#435585] fixed bottom-0 translate-x-1/2 right-1/2 font-semibold hover:bg-[#362f62][#362f62] transition-all duration-150 ease-in-out max-w-sm px-2 md:px-16 py-3 text-white mb-5 rounded-full">
        Proceed To Payment
    </button>

    <div 
    x-cloak
    x-show="validationPayment"
    class="fixed z-50 inset-0 h-screen w-screen flex items-center justify-center">
        <div class="z-50 p-4 flex flex-col items-center justify-center w-full bg-white rounded-md max-w-sm">
            <strong class="font-semibold"> Are You Sure ?</strong>
            <div class="flex gap-2 mt-2">
                <button 
                wire:click="submit"
                class="border  hover:bg-gray-200 transition-all duration-150 ease-in-out rounded-md px-4 py-1">
                    Yes
                </button>
                <button 
                @click="validationPayment = false"
                class="border  hover:bg-gray-200 transition-all duration-150 ease-in-out rounded-md px-4 py-1">
                    No
                </button>
            </div>
        </div>
        <div class="z-40 absolute inset-0 h-screen w-screen bg-black/50 cursor-pointer" @click="validationPayment = false"></div>
    </div>
    
    {{-- Payment --}}
    <div 
    x-cloak
    x-show="proceedPayment"
    class="fixed z-50 inset-0 h-screen w-screen flex items-end justify-center">
        <div class="z-50 bg-white w-full px-5 overscroll-auto py-2 max-w-sm h-[80%] rounded-t-lg overflow-auto">
            <form wire:submit.prevent="openValidationModal">
                <div class="text-center font-normal text-lg">
                    Billing Details
                </div>
                <div class="mt-6">
                    <div>
                        {{$this->createBillingDetailForm}}
                    </div>
                    <div class="flex gap-2">
                        <div 
                        @click="proceedPayment = false"
                        type="submit"
                        class="w-full text-center cursor-pointer py-2 bg-[#435585] hover:bg-[#362f62] text-white rounded-md mt-4">
                            Close
                        </div>
                        <button 
                        type="submit"
                        @click="validationPayment = true"
                        class="w-full text-center py-2 bg-[#435585] hover:bg-[#362f62] text-white rounded-md mt-4">
                            Accept
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="z-40 absolute inset-0 h-screen w-screen bg-black/50 cursor-pointer" @click="proceedPayment = false"></div>
    </div>

    {{-- Edit Accomodation --}}
    <div 
    x-cloak
    x-show="editAccomodation"
    class="fixed z-50 inset-0 h-screen w-screen flex items-center justify-center">
        <div class="z-50 p-4 w-full bg-white rounded-md max-w-sm">
            <form wire:submit.prevent="addAccomodation">
                <div class="text-center font-normal text-lg">
                    Accomodations
                </div>
                <div class="mt-4">
                    {{$this->createAccomodationForm}}
                </div>
                <button 
                type="submit"
                class="w-full py-2 bg-[#435585] hover:bg-[#362f62] text-white rounded-md mt-4">
                    Save
                </button>
            </form>
        </div>
        <div class="z-40 absolute inset-0 h-screen w-screen bg-black/50 cursor-pointer" @click="editAccomodation = false"></div>
    </div>

    {{-- Change Date --}}
    <div 
    x-cloak
    x-show="changeCalender"
    class="fixed z-50 inset-0 h-screen w-screen flex items-center justify-center">
        <div class="z-50 p-4 w-full bg-white rounded-md max-w-sm">
            <form wire:submit.prevent="change">
                <div class="text-center font-normal text-lg">
                    Change Date
                </div>
                <div>
                    {{$this->form}}
                </div>
                <button 
                type="submit"
                class="w-full py-2 bg-[#435585] hover:bg-[#362f62] text-white rounded-md mt-4">
                    Change
                </button>
            </form>
        </div>
        <div class="z-40 absolute inset-0 h-screen w-screen bg-black/50 cursor-pointer" @click="changeCalender = false"></div>
    </div>
</div>