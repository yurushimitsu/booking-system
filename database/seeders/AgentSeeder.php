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
                'agent_id' => '2025001',
                'agent_name' => 'Jeddy Manalili',
                'agent_email' => 'jeddymanalili123@gmail.com',
                'meeting_link' => 'https://meet.google.com/obq-qsnk-ghs',
                'country' => 'USA',
                'profile_picture' => 'profile1.png',
            ],
            [
                'agent_id' => '2025002',
                'agent_name' => 'Testing Name 1',
                'agent_email' => 'test@gmail.com',
                'meeting_link' => 'testing.gmeet.com',
                'country' => 'Australia',
                'profile_picture' => 'profile1.png',
            ],
            [
                'agent_id' => '2025003',
                'agent_name' => 'Testing Name 2',
                'agent_email' => 'test2@gmail.com',
                'meeting_link' => 'testing2.gmeet.com',
                'country' => 'Japan',
                'profile_picture' => 'profile1.png',
            ],
        ];

        DB::table('agents')->insert($multipleAgents);
    }
}
