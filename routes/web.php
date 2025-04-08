<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
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

// Route::get('/login', function () {
//     return view('login');
// });

// Route::get('/agents', [DashboardController::class, 'getAllAgents'])->name('agents');

Route::prefix('agents')->group(function () {
    // Route::get('/all', [DashboardController::class, 'getAllAgents'])->name('agents');
    // Route::get('/search', [DashboardController::class, 'searchAgent'])->name('searchAgent');
    // Route::get('/countries', [DashboardController::class, 'getCountries'])->name('getCountries');
    // Route::get('/agents/search-by-country', [DashboardController::class, 'searchAgentByCountry'])->name('searchAgentByCountry');

});

Route::prefix('appointment')->group(function () {
    // Route::get('/form', [AppointmentController::class, 'getAgentToForm'])->where('agent', '[0-9]+');
    // Route::post('/form', [AppointmentController::class, 'postAppointmentRequest'])->where('agent', '[0-9]+')->name('postAppointmentRequest');

    // Route::get('/getAppointmentsForDate', [AppointmentController::class, 'getAppointmentsForDate']);
});

Route::middleware(['guest'])->prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'login'])->name('login');
    Route::post('/', [LoginController::class, 'loginPost'])->name('login.submit');
});

Route::middleware(['guest'])->prefix('user')->group(function () {
    Route::get('/all-agents', [DashboardController::class, 'getAllAgents'])->name('agents');
    Route::get('/booking-count', [DashboardController::class, 'bookingCount'])->name('bookingCount');

    Route::get('/search-agent', [DashboardController::class, 'searchAgent'])->name('searchAgent');
    Route::get('/countries', [DashboardController::class, 'getCountries'])->name('getCountries');
    Route::get('/search-by-country', [DashboardController::class, 'searchAgentByCountry'])->name('searchAgentByCountry');

    Route::get('/form', [AppointmentController::class, 'getAgentToForm'])->where('agent', '[0-9]+')->name('form');
    Route::post('/form', [AppointmentController::class, 'postAppointmentRequest'])->where('agent', '[0-9]+')->name('postAppointmentRequest');
    Route::get('/getAppointmentsForDate', [AppointmentController::class, 'getAppointmentsForDate']);
});

Route::middleware(['custom.auth', 'role:agent'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'adminDashboard'])->name('adminDashboard');
    Route::get('/appointments', [AdminController::class, 'getAppointments']);
    Route::post('/single-block', [AdminController::class, 'singleDayBlock'])->name('singleDayBlock');
    Route::post('/range-block', [AdminController::class, 'rangeBlock'])->name('rangeBlock');
    Route::delete('/delete/{id}', [AdminController::class, 'deleteBlockedSlot'])->name('deleteBlockedSlot');

    Route::get('/pending-appointments', [AppointmentController::class, 'pendingAppointments'])->name('pendingAppointments');
    Route::post('/approve-appointment', [AppointmentController::class, 'approveAppointment'])->name('approveAppointment');
    Route::post('/reject-appointment', [AppointmentController::class, 'rejectAppointment'])->name('rejectAppointment');

    Route::get('/logout', [LoginController::class, 'logout'])->name('adminLogout');
});

Route::middleware(['custom.auth', 'role:client'])->prefix('client')->group(function () {
    Route::get('/my-bookings', [AppointmentController::class, 'myBookings'])->name('myBookings');
    Route::get('/past-bookings', [AppointmentController::class, 'pastBookings'])->name('pastBookings');

    Route::get('/logout', [LoginController::class, 'logout'])->name('clientLogout');

});

Route::prefix('admin')->group(function () {
    // Route::get('/', function () {
    //     return view('admin.admin');
    // })->name('admin');

    // Route::get('/appointments', [AdminController::class, 'getAppointments']);
    // Route::post('/single-block', [AdminController::class, 'singleDayBlock'])->name('singleDayBlock');
    // Route::post('/range-block', [AdminController::class, 'rangeBlock'])->name('rangeBlock');
    // Route::delete('/delete/{id}', [AdminController::class, 'deleteBlockedSlot'])->name('deleteBlockedSlot');
});

Route::get('/admin/{agent}', [CalendarController::class, 'getAgentAdmin'])->where('agent', '[0-9]+')->name('adminCalendar');
Route::get('/allAppointments/{agent}', [CalendarController::class, 'getAllAppointments']);


Route::get('/fallback', function () {
    return view('fallback'); 
})->name('custom.fallback');

Route::fallback(function () {
    return view('fallback');  
}); 
