<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Http\Middleware\CustomAuthMiddleware;
use App\Models\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request) {
        if (Session::has('user_role')) {
            if (session('user_role') == 'agent') {
                return redirect()->route('adminDashboard');
            } elseif (session('user_role') == 'client') {
                return redirect()->route('myBookings');
            }
        }
        return view('login');
    }

    public function loginPost(Request $request) {
        // Find user by email
        $user = Account::where('account_email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->account_password)) {
            // Store user session ID
            $request->session()->put('user_id', $user->account_no);
            $request->session()->put('user_role', $user->role);

            // Redirect based on the user's role
            switch ($user->role) {
                case 'agent':
                    return redirect()->route('adminDashboard')->with('success', 'Login Success');
                case 'client':
                    // return redirect()->route('myBookings')->with('success', 'Login Success');
                    if (Hash::check('ilovefilglobal', $user->account_password)) {
                        return redirect('/client/change-password')->with('error', 'Please change your password before proceeding');
                    } else {
                        return redirect()->route('myBookings');
                    }
                default:
                    return redirect('/login')->with('error', 'Invalid Role');
            }
        }

        // If credentials don't match
        return redirect('/login')->with('error', 'Invalid email or password');
    }

    public function forgotPassword() {
        return view('forgot-password');
    }

    public function forgotPasswordPost(Request $request) {
        $user = Account::where('account_email', $request->email)
                        ->where('role', 'client')
                        ->first();

        $client = Client::where('client_id', $user->account_no)->first();
        
        if ($user) {
            $tempPass = Str::random(10);
            $user->account_password = Hash::make($tempPass);
            $user->new_user = 1;
            $user->save();

            $mail = new PHPMailer(true);
            try {
                // Server settings
                $mail->isSMTP();                                             // Send using SMTP
                $mail->Host       = 'smtp.hostinger.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                    // Enable SMTP authentication
                $mail->Username   = env('MAIL_USERNAME');                    // SMTP username (your Gmail email address)
                $mail->Password   = env('MAIL_PASSWORD');                    // SMTP password (your Gmail password or App password)
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;             // Enable implicit TLS encryption
                $mail->Port       = 465;                                     // TCP port to connect to

                // Recipients
                $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));  // Sender's email address
                $mail->addAddress($user->account_email);                        // Recipient's email address

                // Load the email content and replace placeholders
                $htmlContent = file_get_contents(resource_path('views/email_contents/email-forgot-password.blade.php'));
                $htmlContent = str_replace('{{client_name}}', $client->client_name, $htmlContent);
                $htmlContent = str_replace('{{temp_pass}}', $tempPass, $htmlContent);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Forgot Password';
                $mail->Body    = $htmlContent;

                // Send the email
                $mail->send();

                // Return a success response
                return response()->json(['success' => true, 'message' => 'Temporary Password Sent!']);
            } catch (Exception $e) {
                // In case of an email error, we rollback the transaction
                DB::rollback();
                return response()->json(['success' => false, 'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Account not found']);
        }
    }

    public function logout(Request $request) {
        if (Session::has('user_id')) {
            $request->session()->flush();

            return redirect()->route('login');
        }
    }
}
