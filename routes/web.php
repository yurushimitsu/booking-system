<?php

use App\Http\Controllers\CalendarController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/calendar/{agent}', [CalendarController::class, 'getAgent'])->where('agent', '[0-9]+')->name('calendar');

Route::prefix('appointments')->group(function () {
    Route::get('/getAppointmentsForDate', [CalendarController::class, 'getAppointmentsForDate']);
    Route::get('/getFullyBookedDates', [CalendarController::class, 'getFullyBookedDates']);

    Route::post('/postRequest', [CalendarController::class, 'postAppointmentRequest'])->name('postAppointmentRequest');
});

Route::get('/admin/{agent}', [CalendarController::class, 'getAgentAdmin'])->where('agent', '[0-9]+')->name('adminCalendar');
Route::get('/allAppointments/{agent}', [CalendarController::class, 'getAllAppointments']);


Route::get('/fallback', function () {
    return view('fallback'); 
})->name('custom.fallback');

Route::fallback(function () {
    return view('fallback');  
}); 
