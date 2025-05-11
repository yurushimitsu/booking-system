<?php

namespace App\Http\Middleware;

use App\Models\Account;
use App\Models\Agent;
use App\Models\Client;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CustomAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is already logged in
        if (Session::has('user_id')) {
            // Fetch the user from the session using the stored account_no
            $user = Account::where('account_no', Session::get('user_id'))->first();
            
            if (!$user) {
                // If the user doesn't exist, log out and redirect to login page
                Session::forget('user_id');
                return redirect('/login')->with('error', 'User session not found.');
            }
            
            // Check if the user's password is still the default password
            if ($user->role === 'client' && Hash::check('ilovefilglobal', $user->account_password)) {
                // Check if the current route is not 'changePasswordNav'
                if (!$request->is('client/change-password') && !Route::is('clientLogout')) {
                    // If the user is a client and still has the default password, and they are not on the change password page
                    return redirect('/client/change-password')->with('error', 'Please change your password before proceeding');
                }
            }

            // If the user exists, allow the request to proceed
            return $next($request);
        }

        // Handle login logic when the user is not logged in
        if ($request->isMethod('post') && $request->has('email') && $request->has('password')) {
            $email = $request->input('email');
            $password = $request->input('password');

            // Find the user by their email address
            $user = Account::where('account_email', $email)->first();

            if ($user && Hash::check($password, $user->account_password)) {
                // Successful login: Store the user's account_no in the session
                $request->session()->put('user_id', $user->account_no);
                $request->session()->put('user_role', $user->role);

                // Redirect based on the user's role
                switch ($user->role) {
                    case 'agent':
                        return redirect()->route('adminDashboard');  // Redirect to admin area
                    case 'client':
                        if (Hash::check('ilovefilglobal', $user->account_password)) {
                            return redirect('/client/change-password')->with('error', 'Please change your password before proceeding');
                        } else {
                            return redirect()->route('myBookings');  // Redirect to user area (agents can be clients too)
                        }
                    default:
                        return redirect('/login')->with('error', 'Invalid role.');
                }
            }

            // If credentials don't match, return back to login page with an error
            return redirect('/login')->with('error', 'Error Email or Password');
        }
        // If no session and no login data, redirect to login page
        return redirect('/login')->with('error', 'You need to login first.');
    }
}
