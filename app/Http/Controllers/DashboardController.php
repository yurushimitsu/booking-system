<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Agent;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function getAllAgents() {
        $allAgents = Agent::select('agent_id', 'agent_name', 'country', 'profile_picture')->get(); 

        $bookingCount = 0;
        if ((Session::has('user_role') && session('user_role') == 'client')) {
            $client = Client::where('client_id', session('user_id'))->first();
            $bookingCount = DB::table('appointments')
                            ->join('agents', 'appointments.agent_id', '=', 'agents.agent_id')
                            ->where('email', $client->client_email)
                            ->where('status', 'accepted')
                            ->where('appointment_date', '>', Carbon::now())
                            ->count();
        }

        return view('client.agents', compact('client','allAgents', 'bookingCount'));
    }

    function searchAgent(Request $request) {
        if ($request->ajax()) {
            $searchQuery = $request->get('query');
            
            // Fetch agents based on search query
            $allAgents = Agent::where('agent_name', 'LIKE', '%' . $searchQuery . '%')->get();
    
            // Return data as JSON response
            return response()->json($allAgents);
        }
    }

    public function getCountries() {
        $countries = Agent::select('country')
                    ->distinct()
                    ->get(); 
        return response()->json($countries);
    }

    public function searchAgentByCountry(Request $request) {
        if ($request->ajax()) {
            $countryName = $request->get('country_name');

            if ($countryName == 'All') {
                $agents = Agent::all();
            } else {
                $agents = Agent::where('country', $countryName)->get();
            }

            // Return agents as a JSON response
            return response()->json($agents);
        }
    }

    public function changePasswordNav() {
        $client = Client::where('client_id', session('user_id'))->first();

        $bookingCount = DB::table('appointments')
                            ->join('agents', 'appointments.agent_id', '=', 'agents.agent_id')
                            ->where('email', $client->client_email)
                            ->where('status', 'accepted')
                            ->where('appointment_date', '>', Carbon::now())
                            ->orderBy('appointment_date')
                            ->count();

        return view('client.change-password', compact('client', 'bookingCount'));
    }

    public function changePassword(Request $request) {
        $old_password = htmlspecialchars($request->input('old-password'));
        $new_password = htmlspecialchars($request->input('new-password'));
        $confirm_password = htmlspecialchars($request->input('confirm-password'));

        $user = Account::where('account_no', session('user_id'))->first();
        if ($user && Hash::check($old_password, $user->account_password)) {
            if ($new_password === $confirm_password) {
                $user->account_password = Hash::make($confirm_password);
                $user->save();

                return response()->json(['success' => true, 'message' => 'Password Changed Successfully']);  
            } else {
                return response()->json(['success' => false, 'message' => "New Password Doesn't Match"]);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Wrong Password']);
        }
    }
}
