<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Http\Middleware\CustomAuthMiddleware;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
                        return redirect()->route('myBookings');  // Redirect to user area (agents can be clients too)
                    }
                default:
                    return redirect('/login')->with('error', 'Invalid Role');
            }
        }

        // If credentials don't match
        return redirect('/login')->with('error', 'Invalid email or password');
    }

    public function logout(Request $request) {
        if (Session::has('user_id')) {
            $request->session()->flush();

            return redirect()->route('login');
        }
    }
}
