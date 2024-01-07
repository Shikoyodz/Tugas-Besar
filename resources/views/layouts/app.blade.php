@extends('layouts.base')

@section('body')
    {{-- <div name="mobile" class="block sm:hidden"> --}}
        @include('mobile.mobile-app')
    {{-- </div> --}}

    {{-- <div name="desktop" class="hidden sm:block">
        @include('desktop.desktop-app')
    </div> --}}
@endsection
