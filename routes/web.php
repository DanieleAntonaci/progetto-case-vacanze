<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ReservationController;
use App\Models\Apartment;
use App\Models\Reservation;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function(){
    return view('auth.login');
})-> name('login');

Route::get('/dasboard',[MainController::class, 'dashboard'] )
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('/register', function(){
    return view('auth.register');
}) -> name('register');


// 
Route::middleware('auth')->group(function () {
    Route::post('/', function(){
        return view('auth.layouts.layout');
    });
    Route::get('/home', function(){
        return view('menu.dashboard');
    });
    // APPARTAMENTI
    Route::get('/apartment', [MainController::class, 'showApartment'])->name('home');
    Route::get('/apartment/{apartment}', [MainController::class,'showSingleApartment'])-> name('singleApartment');

    // PRENOTAZIONI
    Route::get('/prenotazioni', [ReservationController::class, 'showReservation'] )-> name('reservation');
    Route::get('/prenotazioni/prenotazione/{reservation}', [ReservationController::class, 'reservatoionSingle']) -> name('reservationShow');

    // PRICE
    Route::get('/prezzi', [PriceController::class, 'showPrice'])-> name('prices');
    Route::get('/prezzi/creazione', [PriceController::class, 'createPrice'])-> name('priceCreate');
    Route::post('/prezzi/creazione', [PriceController::class, 'storePrice'])-> name('priceStore');


});
Auth::routes();

