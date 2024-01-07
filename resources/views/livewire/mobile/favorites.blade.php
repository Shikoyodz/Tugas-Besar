<div class="px-4">
    <div class="flex gap-4 overflow-y-auto">
        <div class="relative flex-none w-36 h-52 rounded-md">
            <img class="absolute w-full h-full rounded-md" src="{{asset('Deluxe_Room.jpeg')}}" alt="">
            <div class="absolute w-full h-full rounded-md bg-gradient-to-b from-transparent to-[#362f62]"></div>
            <div class="absolute w-full h-full flex flex-col py-3 px-2 justify-between">
                <div class="flex items-center justify-end">
                    <button class="bg-white rounded-full p-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3.5 h-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </button>
                </div>
                <div class="text-white flex flex-col gap-2">
                    <h2 class="text-sm">
                        Deluxe Room
                    </h2>
                    <h2 class="text-sm font-semibold">
                        {{money(10000,'IDR',true)}} / Night
                    </h2>
                </div>
            </div>
        </div>
        <div class="relative flex-none w-36 h-52 rounded-md">
            <img class="absolute w-full h-full rounded-md" src="{{asset('Executive_Room.jpeg')}}" alt="">
            <div class="absolute w-full h-full rounded-md bg-gradient-to-b from-transparent to-[#362f62]"></div>
            <div class="absolute w-full h-full flex flex-col py-3 px-2 justify-between">
                <div class="flex items-center justify-end">
                    <button class="bg-white rounded-full p-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3.5 h-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </button>
                </div>
                <div class="text-white flex flex-col gap-2">
                    <h2 class="text-sm">
                        Executive Room
                    </h2>
                    <h2 class="text-sm font-semibold">
                        {{money(10000,'IDR',true)}} / Night
                    </h2>
                </div>
            </div>
        </div>
        <div class="relative flex-none w-36 h-52 rounded-md">
            <img class="absolute w-full h-full rounded-md" src="{{asset('Residential_Room.jpeg')}}" alt="">
            <div class="absolute w-full h-full rounded-md bg-gradient-to-b from-transparent to-[#362f62]"></div>
            <div class="absolute w-full h-full flex flex-col py-3 px-2 justify-between">
                <div class="flex items-center justify-end">
                    <button class="bg-white rounded-full p-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3.5 h-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </button>
                </div>
                <div class="text-white flex flex-col gap-2">
                    <h2 class="text-sm">
                        Residential Room
                    </h2>
                    <h2 class="text-sm font-semibold">
                        {{money(10000,'IDR',true)}} / Night
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>
