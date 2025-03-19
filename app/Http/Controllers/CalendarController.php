<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Appointment;
use Illuminate\Http\Request;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class CalendarController extends Controller
{
    // CLIENT SIDE START
    // Get agent's calendar based on link
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

    // Get appointments per date
    public function getAppointmentsForDate(Request $request) {
        $date = $request->date;
        $agentAccountNo = $request->agent_account_no;
        
        $appointments = Appointment::whereDate('appointment_date', $date)
                               ->where('agent_no', $agentAccountNo)
                               ->pluck('appointment_time');

        return response()->json($appointments);
    }

    // Check if date is fully booked
    public function getFullyBookedDates(Request $request) {
        $agentAccountNo = $request->agent_account_no;
        
        $fullyBookedDates = Appointment::select('appointment_date')
            ->where('agent_no', $agentAccountNo)
            ->whereIn('appointment_time', ['09:00:00', '10:00:00', '11:00:00', '12:00:00']) // Exact times
            ->groupBy('appointment_date')
            ->havingRaw('COUNT(DISTINCT appointment_time) = 4') // Ensure all 4 slots are booked
            ->pluck('appointment_date');
    
        return response()->json($fullyBookedDates);
    }

    public function postAppointmentRequest(Request $request) {
        $agent_no = htmlspecialchars($request->input('agentAccountNo'));
        $appointment_date = htmlspecialchars($request->input('appointmentDate'));
        $appointment_time = htmlspecialchars($request->input('appointmentTime'));
        $client_name = htmlspecialchars($request->input('name'));
        $client_email = htmlspecialchars($request->input('email'));
        $client_contact = htmlspecialchars($request->input('contact'));
        $client_notes = htmlspecialchars($request->input('notes'));

        $formalDate = date('F j, Y', strtotime($appointment_date)); // Date to be send in email
        $formalTime = date('g:i A', strtotime($appointment_time));  // Time to send in email

        $data = [
            'agent_no' => $agent_no,
            'appointment_date' => $appointment_date,
            'appointment_time' => $appointment_time,
            'client_name' => $client_name,
            'client_email' => $client_email,
            'client_contact' => $client_contact,
            'client_notes' => $client_notes
        ];
    
        $response = Appointment::create($data);
    
        if ($response) {
            $mail = new PHPMailer(true);
    
            try {
                // Server settings
                $mail->isSMTP();                                             // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                        // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                    // Enable SMTP authentication
                $mail->Username   = '';            // SMTP username (your Gmail email address)
                $mail->Password   = '';                   // SMTP password (your Gmail password or App password)
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;             // Enable implicit TLS encryption
                $mail->Port       = 465;                                     // TCP port to connect to
    
                // Recipients
                $mail->setFrom(''); // Sender's email address
                $mail->addAddress($client_email);                 // Recipient's email address
    
                // Content
                $mail->isHTML(true);                                         // Set email format to HTML
                $mail->Subject = 'Appointment Confirmation';
                $mail->Body    = '<h2>This is to confirm your booking appointment in Fil-Global Immigration Services</h2>
                                  <br>
                                  <h3>Following are the details:</h3>
                                  <br>
                                  <h4>Meeting With: '.$agent_no.'</h4><br>
                                  <h4>Client Name: '.$client_name.'</h4><br>
                                  <h4>Appointment Date: '.$formalDate.'</h4><br>
                                  <h4>Appointment Time: '.$formalTime.'</h4><br>
                                  <h4>Appointment Notes: '.$client_notes.'</h4><br>';
    
                $mail->send();
                return response()->json(['success' => true, 'message' => 'Data inserted and email sent successfully!']);
            } catch (Exception $e) {
                return response()->json(['success' => false, 'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to insert data.']);
        }
    }

    // ADMIN SIDE START
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
        $allAppointments = Appointment::where('agent_no', $agent)->get();

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
