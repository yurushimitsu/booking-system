<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $multipleAccounts = [
            [
                'account_no' => '20251001',
                'account_email' => 'jeddymanalili123@gmail.com',
                'account_password' => Hash::make('password'),
                'role' => 'agent',
            ],
            [
                'account_no' => '20251002',
                'account_email' => 'christian@gmail.com',
                'account_password' => Hash::make('password'),
                'role' => 'agent',
            ],
            [
                'account_no' => '20251003',
                'account_email' => 'leizl@gmail.com',
                'account_password' => Hash::make('password'),
                'role' => 'agent',
            ],
        ];

        DB::table('accounts')->insert($multipleAccounts);
    }
}
