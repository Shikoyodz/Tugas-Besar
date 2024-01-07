<div x-data="{
    openModal : false,
    openRoomDetail : false,
}">
    <div class="relative z-50">
        <div class="relative block w-full h-40 z-50 bg-gradient-to-b from-[#435585] to-[#362f62] rounded-b-2xl">
            <div class="w-full flex items-center justify-between p-5 text-white">
                <div class="w-5 h-5">
                    {{-- <img src="{{ asset('Hamba.svg') }}" alt=""> --}}
                </div>
                <div>
                    @if(auth()->check())
                        <button 
                        x-show="!openModal"
                        @click="openModal = true">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>                      
                        </button>
                    @else
                        <a href="{{route('login')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>

            @if(auth()->check())
                <img 
                x-cloak
                x-show="openModal"
                src="https://ui-avatars.com/api/?name={{auth()->user()->name}}"
                alt="{{auth()->user()->name}}.jpg"
                class="absolute translate-x-1/2 right-1/2 translate-y-1/2 bottom-1/2 border-2 rounded-full w-24 h-24">
            @endif

            <div 
            x-cloak
            x-show="openModal"
            class="absolute cursor-pointer select-none bg-white py-2 -bottom-[98px] w-full -z-40 rounded-b-2xl">
                <ul class="py-2">
                    <li>
                        <a href="{{route('profile')}}">
                            <div class="flex items-center justify-between w-full border-b px-4 py-2 hover:bg-gray-100 transition-all duration-150 ease-in-out">
                                <div class="flex items-center gap-3">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>                                      
                                    </div>
                                    <div>
                                        My Profile
                                    </div>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                    </svg>                                      
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('logout')}}">
                            <div class="flex items-center justify-between w-full border-b px-4 py-2 hover:bg-gray-100 transition-all duration-150 ease-in-out">
                                <div class="flex items-center gap-3 text-red-500">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                        </svg>                                                                                                                
                                    </div>
                                    <div>
                                        Logout
                                    </div>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                    </svg>                                      
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div>
        @include('livewire.mobile.components.featured-rooms')
    </div>

    <div>
        @include('livewire.mobile.components.top-rated-rooms')
    </div>
    
    @if(!empty($roomType))
        <div x-show="openRoomDetail">
            @include('livewire.mobile.components.room-detail')
        </div>
    @endif

    <div 
    x-cloak
    x-show="openModal"
    @click="openModal = false"
    class="fixed select-none cursor-pointer z-20 inset-0 w-screen h-screen bg-black/50"></div>
</div>