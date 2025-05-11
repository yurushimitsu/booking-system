<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Account;
use Illuminate\Support\Facades\Session;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the user is logged in (check session)
        if (Session::has('user_id')) {
            // Fetch the user from the session
            $user = Account::where('account_no', Session::get('user_id'))->first();

            if (!$user) {
                // If no user found in the session, force logout and redirect
                Session::forget('user_id');
                return redirect('/login')->with('error', 'User session not found.');
            }

            // Check if the user's role matches the required role
            if ($user->role === $role) {
                return $next($request);
            }

            // If role doesn't match, redirect to an error page
            return redirect('/login')->with('error', 'You do not have access to this page.');
        }

        // If the user is not logged in
        return redirect('/login')->with('error', 'You must be logged in to access this page.');
    }
}
