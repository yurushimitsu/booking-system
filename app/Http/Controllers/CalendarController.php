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

    public function getFullyBookedDates(Request $request) {
        $agentAccountNo = $request->agent_account_no;
        
        $fullyBookedDates = Appointment::select('appointment_date')
            ->where('agent', $agentAccountNo)
            ->whereIn('appointment_time', ['09:00:00', '10:00:00', '11:00:00', '12:00:00']) // Exact times
            ->groupBy('appointment_date')
            ->havingRaw('COUNT(DISTINCT appointment_time) = 4') // Ensure all 4 slots are booked
            ->pluck('appointment_date');
    
        return response()->json($fullyBookedDates);
    }

    public function getAgentAdmin($agent) {
        $agentAdmin = Account::select('account_no', 'agent_name')
                            ->where('account_no', $agent)
                            ->first();
        if ($agentAdmin) {
            return view('admin', compact('agentAdmin'));
        } else {
            return redirect()->route('custom.fallback');
        }
    }

    public function getAllAppointments($agent) {
        $allAppointments = Appointment::where('agent', $agent)->get();

        // Format the data for FullCalendar
        $events = $allAppointments->map(function ($appointment) {
            return [
                'title' => 'Meeting with '.$appointment->client_name, // Or you can use $appointment->client_name
                'start' => $appointment->appointment_date . 'T' . $appointment->appointment_time, // Format for FullCalendar
                'backgroundColor' => '#007bff', // Customize color
                'borderColor' => '#007bff',
            ];
        });

        return response()->json($events);
    }
}
