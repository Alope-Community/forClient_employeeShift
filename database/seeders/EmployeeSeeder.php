<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $unitPersonnel = [
            'Irsan F',
            'Aldi I',
            'Bambang P',
            'M. Ardhika',
            'Oktario',
            'Reza P',
            'Sepriando',
            'Teguh S',
            'Aser F',
            'Muhammad Aldi',
            'Reksa S',
            'Rudi A',
            'Okki P',
            'Muhammad Hafiizh',
            'Recky',
            'Aldo F',
            'Hardinata B',
            'Julham C',
            'Redho M',
            'Satya A',
            'Adam M',
            'M Muarif',
            'Adam E',
            'Harry A',
            'Muhammad Peado',
            'M Hawari',
            'Rahmat F',
            'Tomi A'
        ];

        $wtpPersonnel = [
            'Muhhamad Aldi',
            'Reksa S',
            'Syahru T',
            'Olit R',
            'M Ikhram',
            'Tara dinata',
            'Rendy F',
            'Andi K',
            'Hardinata B',
            'Julham C',
            'Renaldi',
            'Satya A',
            'Aliando S',
            'Wheny S',
            'M Afgan',
            'Inggit E',
            'Harianto A',
            'M Padli',
            'M Ahmad',
            'Raisa F',
            'Tonii A',
            'Andhika P'
        ];

        $ashFgdPersonnel = [
            'Tedi P',
            'Aldi I',
            'Prakoso A',
            'M Lubi',
            'Oktariansyah',
            'Raditya',
            'Suharman',
            'Yazaman',
            'Afriansyah',
            'Alif Kurniawan',
            'M Aldiandi',
            'Reksa S',
            'Rudi A',
            'Olish Zuhir',
            'M Okii',
            'Burhanan',
            'Rafli S',
            'Aldo Paredo',
            'Herlianto',
            'Jumaidi',
            'Rintan Anjani',
            'Mario Teguh',
            'M Zaki',
            'Agusudin',
            'M Ilkhlas',
            'Aidil',
            'Rizky P',
            'Qafi P',
            'Atthar M',
            'Ralin Zapenia',
            'Toni Pratama',
            'Malik A'
        ];

        $allNames = array_merge($unitPersonnel, $wtpPersonnel, $ashFgdPersonnel);
        $users = [];
        $emailCounts = [];

        $usernameCounts = []; // ← Tambahkan ini untuk menghindari username duplikat

        foreach ($allNames as $index => $name) {
            $baseUsername = Str::slug($name, '_');

            // Tangani duplikat username
            if (isset($usernameCounts[$baseUsername])) {
                $usernameCounts[$baseUsername]++;
                $username = $baseUsername . $usernameCounts[$baseUsername];
            } else {
                $usernameCounts[$baseUsername] = 1;
                $username = $baseUsername;
            }

            // Tangani duplikat email berdasarkan username unik
            if (isset($emailCounts[$username])) {
                $emailCounts[$username]++;
                $email = $username . $emailCounts[$username] . '@gmail.com';
            } else {
                $emailCounts[$username] = 1;
                $email = $username . '@gmail.com';
            }

            if (in_array($name, $unitPersonnel)) {
                $division = 'Unit Personnel';
            } elseif (in_array($name, $wtpPersonnel)) {
                $division = 'WTP Personnel';
            } elseif (in_array($name, $ashFgdPersonnel)) {
                $division = 'Ash FGD Personnel';
            } else {
                $division = 'Unknown';
            }

            $users[] = [
                'name' => $name,
                'email' => $email,
                'username' => $username,
                'gender' => 'Pria',
                'address' => $faker->address,
                'phone_number' => '08123' . str_pad($index + 1, 6, '0', STR_PAD_LEFT),
                'division' => $division,
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('foobarrr'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('employees')->insert($users);
    }
}
