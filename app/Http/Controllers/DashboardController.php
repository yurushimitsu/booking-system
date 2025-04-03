<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getAllAgents() {
        $allAgents = Agent::select('agent_id', 'agent_name', 'country', 'profile_picture')->get(); 
        
        return view('client.agents', compact('allAgents'));
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
