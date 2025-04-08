<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Agent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function getAllAgents() {
        $allAgents = Agent::select('agent_id', 'agent_name', 'country', 'profile_picture')->get(); 

        $bookingCount = 0;
        if ((Session::has('user_role') && session('user_role') == 'client')) {
            $client = Account::where('account_no', session('user_id'))->first();
            $bookingCount = DB::table('appointments')
                            ->join('agents', 'appointments.agent_id', '=', 'agents.agent_id')
                            ->where('email', $client->account_email)
                            ->where('status', 'accepted')
                            ->where('appointment_date', '>', Carbon::now())
                            ->count();
        }

        return view('client.agents', compact('allAgents', 'bookingCount'));
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
}
