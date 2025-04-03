<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\AdminController;
use App\Models\Appointment;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/agents', [DashboardController::class, 'getAllAgents'])->name('agents');

Route::prefix('agents')->group(function () {
    Route::get('/all', [DashboardController::class, 'getAllAgents'])->name('agents');
    Route::get('/search', [DashboardController::class, 'searchAgent'])->name('searchAgent');

    Route::get('/countries', [DashboardController::class, 'getCountries'])->name('getCountries');
    Route::get('/agents/search-by-country', [DashboardController::class, 'searchAgentByCountry'])->name('searchAgentByCountry');

});

Route::prefix('appointment')->group(function () {
    Route::get('/form', [AppointmentController::class, 'getAgentToForm'])->where('agent', '[0-9]+');
    Route::post('/form', [AppointmentController::class, 'postAppointmentRequest'])->where('agent', '[0-9]+')->name('postAppointmentRequest');

    Route::get('/getAppointmentsForDate', [AppointmentController::class, 'getAppointmentsForDate']);
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.admin');
    })->name('admin');

    Route::get('/appointments', [AdminController::class, 'getAppointments']);
    Route::post('/single-block', [AdminController::class, 'singleDayBlock'])->name('singleDayBlock');
    Route::post('/range-block', [AdminController::class, 'rangeBlock'])->name('rangeBlock');
    Route::delete('/delete/{id}', [AdminController::class, 'deleteBlockedSlot'])->name('deleteBlockedSlot');
});

Route::get('/admin/{agent}', [CalendarController::class, 'getAgentAdmin'])->where('agent', '[0-9]+')->name('adminCalendar');
Route::get('/allAppointments/{agent}', [CalendarController::class, 'getAllAppointments']);


Route::get('/fallback', function () {
    return view('fallback'); 
})->name('custom.fallback');

Route::fallback(function () {
    return view('fallback');  
}); 
