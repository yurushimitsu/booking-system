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
        DB::table('agents')->insert([
            'account_no'=> '20251001',
            'agent_name'=> 'Jeddy Manalili',
            'agent_email'=> 'jeddymanalili123@gmail.com',
            'country'=> 'Jeddy Manalili',
            'profile_picture'=> 'test_profile2.png',
        ]);
    }
}
