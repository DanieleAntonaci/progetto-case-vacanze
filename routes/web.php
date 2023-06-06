<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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



// Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::middleware('guest')->group(function () {

// });
Route::get('/', function(){
    return view('auth.login');
})-> name('login');

Route::get('/dasboard',[MainController::class, 'dashboard'] )
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('/register', function(){
    return view('auth.register');
}) -> name('register');

Route::middleware('auth')->group(function () {
    Route::post('/', function(){
        return view('auth.layouts.layout');
    });

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
