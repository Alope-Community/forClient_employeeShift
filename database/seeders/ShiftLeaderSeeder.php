<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShiftLeaderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('shift_leaders')->insert([
            [
                'name' => 'Dewi Kartika',
                'email' => 'dewi.kartika@example.com',
                'username' => 'dewik',
                'gender' => 'Wanita',
                'address' => 'Jl. Kenanga No. 10, Surabaya',
                'phone_number' => '081122334455',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('foobarrr'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'username' => 'budis',
                'gender' => 'Pria',
                'address' => 'Jl. Anggrek No. 5, Yogyakarta',
                'phone_number' => '082233445566',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('foobarrr'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
