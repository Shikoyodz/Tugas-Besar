<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', \App\Livewire\Home::class)->name('home');
Route::middleware('guest')->group(function() {
    Route::get('/login', \App\Livewire\Login::class)->name('login');
    Route::get('/signup',\App\Livewire\Signup::class)->name('signup');
});

Route::middleware('auth')->group(function(){
    Route::get('/profile', \App\Livewire\Profile::class)->name('profile');
    Route::get('/discovery', \App\Livewire\Discovery::class)->name('discovery');
    // Route::get('/favorites', \App\Livewire\Favorites::class)->name('favorites');
    Route::get('/booking/{roomType:id}/{room:id}', \App\Livewire\Booking::class)->name('booking');
    Route::get('/booking-detail', \App\Livewire\BookingDetail::class)->name('booking-detail');
    Route::get('/logout',function(){
        Auth::logout();

        return redirect()->to(route('home'));
    })->name('logout');
});
