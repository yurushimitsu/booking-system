<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Appointment;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function getAgent($agent) {
        $agentName = Account::select('account_no', 'agent_name')
                            ->where('account_no', $agent)
                            ->first();
        if ($agentName) {
            return view('calendar', compact('agentName'));
        } else {
            return redirect()->route('custom.fallback');
        }
    }

    public function getAppointmentsForDate(Request $request) {
        // $appointments = Appointment::whereDate('appointment_date', $request->date)->pluck('appointment_time');
        $date = $request->date;
        $agentAccountNo = $request->agent_account_no;
        
        $appointments = Appointment::whereDate('appointment_date', $date)
                               ->where('agent', $agentAccountNo)
                               ->pluck('appointment_time')
                               ->map(function ($time) {
                                   return (int) substr($time, 0, 2); // Extracting hour from HH:MM:SS
                               });

        return response()->json($appointments);
    }
}
