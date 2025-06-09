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
                'name' => 'Andi Saputra',
                'email' => 'andi@gmail.com',
                'username' => 'andis',
                'gender' => 'Pria',
                'address' => 'Jl. Melati No. 21, Bandung',
                'phone_number' => '082198765432',
                'division' => 'WTP Personnel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('foobarrr'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rudi Pandjaitan',
                'email' => 'rudi@gmail.com',
                'username' => 'rudi',
                'gender' => 'Pria',
                'address' => 'Jl. Soekarno No. 2, Yogyakarta',
                'phone_number' => '082198765432',
                'division' => 'Ash FGD Personnel',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('foobarrr'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
