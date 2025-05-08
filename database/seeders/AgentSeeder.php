<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $multipleAgents = [
            [
                'agent_id' => '20251001',
                'agent_name' => 'Jeddy Manalili',
                'agent_email' => 'jeddymanalili123@gmail.com',
                'meeting_link' => 'https://meet.google.com/obq-qsnk-ghs',
                'country' => 'Jeddy Manalili',
                'profile_picture' => 'profile1.png',
            ],
            [
                'agent_id' => '20251002',
                'agent_name' => 'Christian Ian Castaneda',
                'agent_email' => 'christian@gmail.com',
                'meeting_link' => 'christian.gmeet.com',
                'country' => 'Jeddy Manalili',
                'profile_picture' => 'profile1.png',
            ],
            [
                'agent_id' => '20251003',
                'agent_name' => 'Leizl Dimanalata',
                'agent_email' => 'leizl@gmail.com',
                'meeting_link' => 'christian.gmeet.com',
                'country' => 'Jeddy Manalili',
                'profile_picture' => 'profile1.png',
            ],
        ];

        DB::table('agents')->insert($multipleAgents);
    }
}
