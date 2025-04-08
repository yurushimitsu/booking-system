<?php

namespace App\Http\Middleware;

use App\Models\Account;
use App\Models\Agent;
use App\Models\Client;
use Closure;
use Illuminate\Http\Request;
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
        // if (Session::has('agent_id')) {
        //     return $next($request);
        // } else {
        //     $email = $request->email;
        //     $password = $request->password;
        //     $user = Account::where('account_email', $email)
        //                     ->where('role', 'agent')
        //                     ->first();

        //     if ($user && Hash::check($password, $user->account_password)) {
        //         $agent = Agent::where('agent_id', $user->account_no)->first();
        //         $request->session()->put('agent_id', $agent->agent_id);

        //         return $next($request);
        //     }

        //     return redirect('/login')->with('error', 'Error Email or Password');
        // }

        // if (Session::has('user_id')) {
        //     // Fetch the current user's role from the session or database
        //     $user = Account::where('account_no', Session::get('user_id'))->first();
        //     return $next($request);
        // } else {
        //     // Check credentials if no session exists
        //     $email = $request->email;
        //     $password = $request->password;
    
        //     $user = Account::where('account_email', $email)
        //                    ->first();
    
        //     if ($user && Hash::check($password, $user->account_password)) {
        //         // Store user session ID and role
        //         $request->session()->put('user_id', $user->account_no);

        //         return $next($request);
    
        //         // After login, check the user's role
        //         switch ($user->role) {
        //             case 'agent':
        //                 return redirect()->route('adminDashboard');  // Redirect to admin area
        //             case 'client':
        //                 return redirect('/user/dashboard');  // Redirect to user area
        //             default:
        //                 return redirect('/login')->with('error', 'Invalid Role');
        //         }
        //     }
    
        //     return redirect('/login')->with('error', 'Error Email or Password');
        // }
    
        // return $next($request);

        // Check if the user is already authenticated
        // if (Session::has('user_id')) {
        //     // Fetch the current user's data
        //     $user = Account::where('account_no', Session::get('user_id'))->first();

        //     // Check if the user exists
        //     if (!$user) {
        //         // If no user found, force logout and redirect to login
        //         Session::forget('user_id');
        //         return redirect('/login')->with('error', 'User session not found.');
        //     }

        //     // If the user exists, allow the request to proceed
        //     return $next($request);
        // } else {
        //     // If the user isn't logged in, handle the login logic
        //     $email = $request->email;
        //     $password = $request->password;

        //     // Find user by email
        //     $user = Account::where('account_email', $email)->first();

        //     if ($user && Hash::check($password, $user->account_password)) {
        //         // Store user session ID
        //         $request->session()->put('user_id', $user->account_no);

        //         // Redirect based on the user's role
        //         switch ($user->role) {
        //             case 'agent':
        //                 return redirect()->route('adminDashboard');  // Redirect to admin area
        //             case 'client':
        //                 return redirect()->route('agents');  // Redirect to admin area
        //             default:
        //                 return redirect('/login')->with('error', 'Invalid role.');
        //         }
        //     }

        //     // If credentials don't match
        //     return redirect('/login')->with('error', 'Error Email or Password');
        // }



        // Check if the user is already logged in
        if (Session::has('user_id')) {
            // Fetch the user from the session using the stored account_no
            $user = Account::where('account_no', Session::get('user_id'))->first();
            
            if (!$user) {
                // If the user doesn't exist, log out and redirect to login page
                Session::forget('user_id');
                return redirect('/login')->with('error', 'User session not found.');
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
                        return redirect()->route('myBookings');  // Redirect to user area (agents can be clients too)
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
