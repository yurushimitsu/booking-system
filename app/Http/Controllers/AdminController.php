<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use Carbon\Carbon;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getAppointments(Request $request) {
        $weekOffset = $request->query('week', 0);
        $startOfWeek = Carbon::now()->startOfWeek()->addWeeks($weekOffset);
        $endOfWeek = $startOfWeek->copy()->addDays(6);

        $appointments = Appointment::whereBetween('appointment_date', [$startOfWeek, $endOfWeek])->get();
        
        return response()->json($appointments);
    }
}
