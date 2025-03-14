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

// Route::get('/calendar', function () {
//     return view('calendar');
// });

Route::get('/calendar/{agent}', [CalendarController::class, 'getAgent'])->name('calendar');
// Route::get('/calendar/{agent}/fetchAppointments', [CalendarControlRoute::get('/appointments/getAppointmentsForDate', [AppointmentController::class, 'getAppointmentsForDate']);
Route::get('/appointments/getAppointmentsForDate', [CalendarController::class, 'getAppointmentsForDate']);

Route::get('/fallback', function () {
    return view('fallback'); // Assuming you have a fallback view
})->name('custom.fallback');

Route::fallback(function () {
    return view('fallback');  
}); 
