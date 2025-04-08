<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Agent;
use App\Models\Appointment;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class AppointmentController extends Controller
{

    public function pendingAppointments() {

        $pendingAppointments = DB::table('agents')
                            ->join('appointments', 'agents.agent_id', '=', 'appointments.agent_id')
                            ->where('appointments.status', 'pending')
                            ->where('appointments.agent_id', session('user_id'))
                            ->select('agents.meeting_link', 'appointments.*')
                            ->get();

        return response()->json($pendingAppointments);
    }

    public function approveAppointment(Request $request) {
        $appointmentId = $request->input('appointmentId');

        $appointment = Appointment::find($appointmentId);
        if ($appointment) {
            $appointment->status = 'accepted';
            $appointment->save();
    
            return response()->json(['success' => true, 'message' => 'Appointment approved']);
        } else {
            return response()->json(['success' => false, 'message' => 'Appointment not found']);
        }
    }

    public function rejectAppointment(Request $request) {
        $appointmentId = $request->input('appointmentId');
        $reason = $request->input('reason');

        $appointment = Appointment::find($appointmentId);
        if ($appointment) {
            $appointment->status = 'rejected';
            $appointment->notes = $reason;
            $appointment->save();
    
            return response()->json(['success' => true, 'message' => 'Appointment rejected']);
        } else {
            return response()->json(['success' => false, 'message' => 'Appointment not found']);
        }
    }

    public function getAgentToForm(Request $request) {
        $agent_no = $request->query('agent');
        $row = Agent::select('agent_id', 'agent_name', 'agent_email', 'profile_picture')
                            ->where('agent_id', $agent_no)
                            ->first();
        if ($row) {
            return view('client.appointment-form', compact('row', 'agent_no'));
        } else {
            return redirect()->route('custom.fallback');
        }
    }

    // Get appointments per date
    public function getAppointmentsForDate(Request $request) {
        $date = $request->date;
        $agentAccountNo = $request->agent_account_no;
        
        $appointments = Appointment::whereDate('appointment_date', $date)
                               ->where('agent_id', $agentAccountNo)
                               ->whereNotIn('status', ['rejected'])
                               ->pluck('appointment_time');

        return response()->json($appointments);
    }
    
    // Post appointment request and email
    public function postAppointmentRequest(Request $request) {
        $agent_no = htmlspecialchars($request->input('agent_account_no'));
        $client_name = htmlspecialchars($request->input('fullname'));
        $client_email = htmlspecialchars($request->input('email'));
        $client_contact = htmlspecialchars($request->input('contact'));
        $appointment_type = htmlspecialchars($request->input('appointment_type'));
        $appointment_date = htmlspecialchars($request->input('appointment_date'));
        $appointment_time = htmlspecialchars($request->input('appointment_time'));
        $client_notes = htmlspecialchars($request->input('notes'));

        $formalDate = date('F j, Y', strtotime($appointment_date)); // Date to be send in email
        $formalTime = date('g:i A', strtotime($appointment_time));  // Time to send in email
        $agentName = Agent::select('agent_name')->where('agent_id', $agent_no)->first(); // Agent name to send in email
        $todayDate = date('F j, Y');

        $data = [
            'agent_id' => $agent_no,
            'appointment_type' => $appointment_type,
            'appointment_date' => $appointment_date,
            'appointment_time' => $appointment_time,
            'name' => $client_name,
            'email' => $client_email,
            'contact' => $client_contact,
            'notes' => $client_notes,
            'status' => 'pending'
        ];
    
        $response = Appointment::create($data);
    
        if ($response) {
            $mail = new PHPMailer(true);
    
            try {
                // Server settings
                $mail->isSMTP();                                             // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                        // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                    // Enable SMTP authentication
                $mail->Username   = env('MAIL_USERNAME');            // SMTP username (your Gmail email address)
                $mail->Password   = env('MAIL_PASSWORD');                   // SMTP password (your Gmail password or App password)
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;             // Enable implicit TLS encryption
                $mail->Port       = 465;                                     // TCP port to connect to
    
                // Recipients
                $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')); // Sender's email address
                $mail->addAddress($client_email);                 // Recipient's email address
    
                $htmlContent = file_get_contents(resource_path('views/email_contents/email-confirmation.blade.php'));

                // Replace placeholders with actual values
                $htmlContent = str_replace('{{client_name}}', $client_name, $htmlContent);
                $htmlContent = str_replace('{{appointment_type}}', $appointment_type, $htmlContent);
                $htmlContent = str_replace('{{formalDate}}', $formalDate, $htmlContent);
                $htmlContent = str_replace('{{formalTime}}', $formalTime, $htmlContent);
                $htmlContent = str_replace('{{todayDate}}', $todayDate, $htmlContent);
                $htmlContent = str_replace('{{agentName}}', $agentName->agent_name, $htmlContent);
                
                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Appointment Confirmation';
                $mail->Body = $htmlContent;                
    
                $mail->send();
                return response()->json(['success' => true, 'message' => 'Data inserted and email sent successfully!']);
            } catch (Exception $e) {
                return response()->json(['success' => false, 'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to insert data.']);
        }
    }

    public function myBookings() {
        $client = Account::where('account_no', session('user_id'))->first();

        $pendingBookings = DB::table('appointments')
                            ->join('agents', 'appointments.agent_id', '=', 'agents.agent_id')
                            ->where('email', $client->account_email)
                            ->where('status', 'pending')
                            ->where('appointment_date', '>', Carbon::now())
                            ->get();

        $approvedBookings = DB::table('appointments')
                            ->join('agents', 'appointments.agent_id', '=', 'agents.agent_id')
                            ->where('email', $client->account_email)
                            ->where('status', 'accepted')
                            ->where('appointment_date', '>', Carbon::now())
                            ->get();

        $bookingCount = $approvedBookings->count();

        $rejectedBookings = DB::table('appointments')
                            ->join('agents', 'appointments.agent_id', '=', 'agents.agent_id')
                            ->where('email', $client->account_email)
                            ->where('status', 'rejected')
                            ->where('appointment_date', '>', Carbon::now())
                            ->get();

        return view('client.my-bookings', compact('pendingBookings', 'approvedBookings', 'rejectedBookings', 'bookingCount'));
    }

    public function pastBookings() {
        $client = Account::where('account_no', session('user_id'))->first();

        $approvedBookings = DB::table('appointments')
                            ->join('agents', 'appointments.agent_id', '=', 'agents.agent_id')
                            ->where('email', $client->account_email)
                            ->where('status', 'accepted')
                            ->where('appointment_date', '<', Carbon::now())
                            ->get();

        $bookingCount = DB::table('appointments')
                            ->join('agents', 'appointments.agent_id', '=', 'agents.agent_id')
                            ->where('email', $client->account_email)
                            ->where('status', 'accepted')
                            ->where('appointment_date', '>', Carbon::now())
                            ->count();

        $rejectedBookings = DB::table('appointments')
                            ->join('agents', 'appointments.agent_id', '=', 'agents.agent_id')
                            ->where('email', $client->account_email)
                            ->where('status', 'rejected')
                            ->where('appointment_date', '<', Carbon::now())
                            ->get();

        return view('client.past-bookings', compact('approvedBookings', 'rejectedBookings', 'bookingCount'));

    }
}
