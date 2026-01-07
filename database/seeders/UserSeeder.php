<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Ankur jha',
                'phone' => '7763972896',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'rupesh',
                'phone' => '2222222222',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
            [
                'name' => 'avisekh tripathi',
                'phone' => '1111111111',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
        ]);
    }
}
