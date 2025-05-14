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
                'account_no' => '2025001',
                'account_email' => 'jeddymanalili123@gmail.com',
                'account_password' => Hash::make('ilovefilglobal'),
                'role' => 'agent',
            ],
            [
                'account_no' => '2025002',
                'account_email' => 'test@gmail.com',
                'account_password' => Hash::make('ilovefilglobal'),
                'role' => 'agent',
            ],
            [
                'account_no' => '2025003',
                'account_email' => 'test2@gmail.com',
                'account_password' => Hash::make('ilovefilglobal'),
                'role' => 'agent',
            ],
        ];

        DB::table('accounts')->insert($multipleAccounts);
    }
}
