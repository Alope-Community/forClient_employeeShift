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
            // Unit Personnel
            [
                'name' => 'Meranda',
                'email' => 'randa@gmail.com',
                'username' => 'randa',
                'gender' => 'Wanita',
                'address' => 'Jl. Mawar No. 12, Jakarta',
                'phone_number' => '081234567890',
                'division' => 'Unit Personnel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('foobarrr'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fikri Ramadhan',
                'email' => 'fikri@gmail.com',
                'username' => 'fikri',
                'gender' => 'Pria',
                'address' => 'Jl. Merapi No. 27, Yogyakarta',
                'phone_number' => '082198765441',
                'division' => 'Ash FGD Personnel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('foobarrr'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Taufan',
                'email' => 'taufan@gmail.com',
                'username' => 'taufan',
                'gender' => 'Pria',
                'address' => 'Jl. Merapi No. 27, Yogyakarta',
                'phone_number' => '082198765441',
                'division' => 'WTP Personnel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('foobarrr'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bambang',
                'email' => 'bambang@gmail.com',
                'username' => 'bambang',
                'gender' => 'Pria',
                'address' => 'Jl. Merapi No. 27, Yogyakarta',
                'phone_number' => '082198765441',
                'division' => 'WTP Personnel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('foobarrr'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Yanto',
                'email' => 'yanto@gmail.com',
                'username' => 'yanto',
                'gender' => 'Pria',
                'address' => 'Jl. Merapi No. 27, Yogyakarta',
                'phone_number' => '082198765441',
                'division' => 'WTP Personnel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('foobarrr'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
