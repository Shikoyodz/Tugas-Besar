<div class="relative w-full max-w-sm h-full min-h-screen shadow-md bg-white mx-auto">
    @if(checking_route_name_is_equal(['login','signup','profile','discovery','favorites','booking','booking-detail']))
        @include('components.mobile.navbar')
    @endif

    {{ $slot ?? '' }}

    @if(!checking_route_name_is_equal(['login','signup','profile','booking']))
        <div class="fixed w-full px-4 max-w-sm bottom-5">
            <div class="w-full flex justify-center items-center bg-[#435585] rounded-full">
                <ul class="flex justify-between items-center w-full text-[#F5E8C6] px-2">
                    <li class="grow">
                        <a href="{{route('home')}}" class="text-sm flex px-4 py-2 flex-col items-center text-center justify-center">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                                    <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                                </svg>
                            </div>
                            Home
                        </a>
                    </li>
                    <li class="grow">
                        <a href="{{route('discovery')}}" class="text-sm flex px-4 py-2 flex-col items-center text-center justify-center">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path d="M12.69 12.19L4.5 16L8.31 7.81L16.5 4M10.5 0C9.18678 0 7.88642 0.258658 6.67317 0.761205C5.45991 1.26375 4.35752 2.00035 3.42893 2.92893C1.55357 4.8043 0.5 7.34784 0.5 10C0.5 12.6522 1.55357 15.1957 3.42893 17.0711C4.35752 17.9997 5.45991 18.7362 6.67317 19.2388C7.88642 19.7413 9.18678 20 10.5 20C13.1522 20 15.6957 18.9464 17.5711 17.0711C19.4464 15.1957 20.5 12.6522 20.5 10C20.5 8.68678 20.2413 7.38642 19.7388 6.17317C19.2362 4.95991 18.4997 3.85752 17.5711 2.92893C16.6425 2.00035 15.5401 1.26375 14.3268 0.761205C13.1136 0.258658 11.8132 0 10.5 0ZM10.5 8.9C10.2083 8.9 9.92847 9.01589 9.72218 9.22218C9.51589 9.42847 9.4 9.70826 9.4 10C9.4 10.2917 9.51589 10.5715 9.72218 10.7778C9.92847 10.9841 10.2083 11.1 10.5 11.1C10.7917 11.1 11.0715 10.9841 11.2778 10.7778C11.4841 10.5715 11.6 10.2917 11.6 10C11.6 9.70826 11.4841 9.42847 11.2778 9.22218C11.0715 9.01589 10.7917 8.9 10.5 8.9Z" fill="#F5E8C6"/>
                                </svg>
                            </div>
                            Discovery
                        </a>
                    </li>
                    {{-- <li class="grow">
                        <a href="{{route('favorites')}}" class="text-sm flex px-4 py-2 flex-col items-center text-center justify-center">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                            </div>
                            Favorites
                        </a>
                    </li> --}}
                    <li class="grow">
                        <a href="{{route('booking-detail')}}" class="text-sm flex px-4 py-2 flex-col items-center text-center justify-center">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                </svg>
                            </div>
                            Bookings
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    @endif
</div>
