<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('employees')->insert([
            [
                'name' => 'Rina Wijaya',
                'email' => 'rina@example.com',
                'username' => 'rinaw',
                'gender' => 'Wanita',
                'address' => 'Jl. Mawar No. 12, Jakarta',
                'phone_number' => '081234567890',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('foobarrr'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Andi Saputra',
                'email' => 'andi@example.com',
                'username' => 'andis',
                'gender' => 'Pria',
                'address' => 'Jl. Melati No. 21, Bandung',
                'phone_number' => '082198765432',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('foobarrr'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
