<div class="fixed bg-white w-full max-w-sm px-5 py-4 border-b mb-5">
    <div class="flex gap-2">
        <a href="{{url()->previous()}}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg>              
        </a>
        <div>
            <Strong>{{ucfirst(route_name())}}</Strong>
        </div>
    </div>
</div>
<div class="h-20"></div>