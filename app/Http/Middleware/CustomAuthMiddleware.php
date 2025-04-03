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
        if (Session::has('agent_id')) {
            return $next($request);
        } else {
            $email = $request->email;
            $password = $request->password;
            $user = Account::where('account_email', $email)
                            ->where('role', 'agent')
                            ->first();

            if ($user && Hash::check($password, $user->account_password)) {
                $agent = Agent::where('agent_id', $user->account_no)->first();
                $request->session()->put('agent_id', $agent->agent_id);

                return $next($request);
            }

            return redirect('/login')->with('error', 'Error Email or Password');
        }
    }
}
