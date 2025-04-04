<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Appointment;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function adminDashboard () {
        $agent = Agent::where('agent_id', session('agent_id'))->first();

        // if ($agent) {
            return view('admin.admin', compact('agent'));
        // } else {
        //     return redirect()->route('custom.fallback');
        // }
    }

    public function getAppointments(Request $request) {
        $weekOffset = $request->query('week', 0);
        $startOfWeek = Carbon::now()->startOfWeek()->addWeeks($weekOffset);
        $endOfWeek = $startOfWeek->copy()->addDays(6);
        
        $appointments = DB::table('agents')
                            ->join('appointments', 'agents.agent_id', '=', 'appointments.agent_id')
                            ->whereBetween('appointments.appointment_date', [$startOfWeek, $endOfWeek])
                            ->where('appointments.agent_id', session('agent_id'))
                            ->select('agents.meeting_link', 'appointments.*')
                            ->get();
        
        return response()->json($appointments);
    }

    public function singleDayBlock(Request $request) {
        $date = htmlspecialchars($request->input('calendar-date'));
        $times = $request->input('times', []);
        $reason = htmlspecialchars($request->input('s-reason'));

        if ($times === null || empty($times)) {
            return response()->json(['success' => false, 'message' => 'Please select a time slot']);
        }
        
        if (in_array('s-select-all', $times)) {
            $times = [
                '08:00:00',
                '09:00:00',
                '10:00:00',
                '11:00:00',
                '13:00:00',
                '14:00:00',
                '15:00:00',
                '16:00:00'
            ];
        }

        // Initialize message
        $message = 'Time slots blocked successfully';

        foreach ($times as $time) {
            $existingAppointment = Appointment::where('appointment_date', $date)
                                            ->where('appointment_time', $time)
                                            ->where('agent_id', session('agent_id'))
                                            ->first();

            if ($existingAppointment) {
                if ($existingAppointment->status == 'blocked') {
                    $blockedTimes[] = $time;
                    $message = "The following time slot are already blocked: " . implode(', ', array_map(fn($time) => Carbon::createFromFormat('H:i:s', $time)->format('g:i A'), $blockedTimes));
                }

                if ($existingAppointment->status == 'accepted') {
                    $acceptedTimes[] = $time;
                    $message = "The following time slot has an appointment: ". implode(', ', array_map(fn($time) => Carbon::createFromFormat('H:i:s', $time)->format('g:i A'), $acceptedTimes));
                }

                continue;
            } 

            $agent = Agent::where('agent_id', session('agent_id'))->first();

            $data = [
                'agent_id' => $agent->agent_id,
                'appointment_date' => $date,
                'appointment_time' => $time,
                'notes' => $reason,

                'appointment_type' => 'Blocked',
                'name' => $agent->agent_name,
                'email' => $agent->agent_email,
                'contact' => '09123456787',
                'status' => 'blocked'
            ];

            Appointment::create($data);
        }

        return response()->json(['success' => true, 'message' => $message]);
    }

    public function rangeBlock(Request $request) {
        $startDate = htmlspecialchars($request->input('start-date'));
        $endDate = htmlspecialchars($request->input('end-date'));
        $times = $request->input('times', []);
        $reason = htmlspecialchars($request->input('r-reason'));

        if ($times === null || empty($times)) {
            return response()->json(['success' => false, 'message' => 'Please select a time slot']);
        }
    
        if (in_array('r-select-all', $times)) {
            $times = [
                '08:00:00',
                '09:00:00',
                '10:00:00',
                '11:00:00',
                '13:00:00',
                '14:00:00',
                '15:00:00',
                '16:00:00'
            ];
        }
    
        // Convert start and end dates to Carbon instances
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);
    
        // Loop through the date range from startDate to endDate (inclusive)
        $currentDate = $startDate;
        while ($currentDate <= $endDate) {

            // Initialize message
            $message = 'Time slots blocked successfully';

            foreach ($times as $time) {
                $existingAppointment = Appointment::where('appointment_date', $currentDate->toDateString())
                                                ->where('appointment_time', $time)
                                                ->where('agent_id', session('agent_id'))
                                                ->first();

                if ($existingAppointment) {
                    if ($existingAppointment->status == 'blocked') {
                        $blockedTimes[] = $time;
                        $message = "The following time slot are already blocked: " . implode(', ', array_map(fn($time) => Carbon::createFromFormat('H:i:s', $time)->format('g:i A'), $blockedTimes));
                    }

                    if ($existingAppointment->status == 'accepted') {
                        $acceptedTimes[] = $time;
                        $message = "The following time slot has an appointment: ". implode(', ', array_map(fn($time) => Carbon::createFromFormat('H:i:s', $time)->format('g:i A'), $acceptedTimes));
                    }
                    continue;
                } 

                $agent = Agent::where('agent_id', session('agent_id'))->first();

                $data = [
                    'agent_id' => $agent->agent_id,
                    'appointment_date' => $currentDate->toDateString(),
                    'appointment_time' => $time,
                    'notes' => $reason,

                    'appointment_type' => 'Blocked',
                    'name' => $agent->agent_name,
                    'email' => $agent->agent_email,
                    'contact' => '09123456787',
                    'status' => 'blocked'
                ];

                Appointment::create($data);
            }
    
            // Move to the next day
            $currentDate->addDay();
            continue;
        }
    
        return response()->json(['success' => true, 'message' => $message]);
    }

    public function deleteBlockedSlot($id) {
        $appointment = Appointment::findOrFail($id);

        $formalDate = Carbon::parse($appointment->appointment_date)->format('F j, Y');
        $formalTime = Carbon::parse($appointment->appointment_time)->format('g:i A');

        if ($appointment->status === 'blocked') {
            $appointment->delete();
            return response()->json(['success' => true, 'message' => $formalDate.' on '.$formalTime.' is now open for appointments']);
        }
        return response()->json(['success' => false, 'message' => 'Error']);
    }
}
