<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('appointments')->insert([
            'agent'=> '20251234',
            'client_name'=> 'Jeddy Manalili',
            'appointment_date'=> '2025-03-17',
            'appointment_time'=> '09:00:00',
        ]);
    }
}
