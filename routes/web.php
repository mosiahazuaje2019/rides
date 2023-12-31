<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\api\v1\UserController;
use App\Http\Controllers\api\v1\BookingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        //'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
/*      Route::get('/dashboard', function () {
         return Inertia::render('Dashboard');
     })->name('dashboard'); */
    Route::get('/dashboard', function () { return Inertia::render('Bookings/index'); })->name('dashboard');
    Route::get('/booking', function () { return Inertia::render('Bookings/index'); })->name('booking');
    Route::get('user', function () { return Inertia::render('Users/index'); })->name('user');
});

Route::group(['prefix' => 'api/v1'], function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('bookings', BookingController::class);

    //User custom routes GET
    Route::get('get_drivers', [UserController::class,'get_drivers']);

    //Booking custom routes GET
    Route::get('filterByDate', [BookingController::class, 'filterByDate']);
    Route::get('filterContains', [BookingController::class, 'filterContains']);

    //Booking custom route GET open parameters
    Route::get('filterByCriteria', [BookingController::class, 'filterByCriteria']);

    //Booking custom routes POST
    Route::post('cabosrwh', [BookingController::class,'cabosrwh']);

    Route::get('report/{date?}', [BookingController::class, 'generatePDF']);



});
