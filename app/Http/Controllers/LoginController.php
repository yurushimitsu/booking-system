<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CustomAuthMiddleware;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login() {
        return view('login');
    }

    public function loginPost(Request $request) {
        $middleware = new CustomAuthMiddleware();

        $response = $middleware->handle($request, function($request){
            return redirect()->route('adminDashboard')->with('success', 'Login Success');
        });

        return $response;
    }

    public function logout(Request $request) {
        if (Session::has('agent_id')) {
            $request->session()->flush();

            return redirect()->route('login');
        }

        // return redirect()->route('login');
    }
}
