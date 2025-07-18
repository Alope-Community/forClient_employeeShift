<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $unitPersonnel = [
            'Irsan F', 'Aldi I', 'Bambang P', 'M. Ardhika', 'Oktario',
            'Reza P', 'Sepriando', 'Teguh S', 'Aser F', 'Muhammad Aldi',
            'Reksa S', 'Rudi A', 'Okki P', 'Muhammad Hafiizh', 'Recky',
            'Aldo F', 'Hardinata B', 'Julham C', 'Redho M', 'Satya A',
            'Adam M', 'M Muarif', 'Adam E', 'Harry A', 'Muhammad Peado',
            'M Hawari', 'Rahmat F', 'Tomi A'
        ];

        $wtpPersonnel = [
            'Muhhamad Aldi', 'Reksa S', 'Syahru T', 'Olit R', 'M Ikhram',
            'Tara dinata', 'Rendy F', 'Andi K', 'Hardinata B', 'Julham C',
            'Renaldi', 'Satya A', 'Aliando S', 'Wheny S', 'M Afgan',
            'Inggit E', 'Harianto A', 'M Padli', 'M Ahmad', 'Raisa F',
            'Tonii A', 'Andhika P'
        ];

        $ashFgdPersonnel = [
            'Tedi P', 'Aldi I', 'Prakoso A', 'M Lubi', 'Oktariansyah',
            'Raditya', 'Suharman', 'Yazaman', 'Afriansyah', 'Alif Kurniawan',
            'M Aldiandi', 'Reksa S', 'Rudi A', 'Olish Zuhir', 'M Okii',
            'Burhanan', 'Rafli S', 'Aldo Paredo', 'Herlianto', 'Jumaidi',
            'Rintan Anjani', 'Mario Teguh', 'M Zaki', 'Agusudin', 'M Ilkhlas',
            'Aidil', 'Rizky P', 'Qafi P', 'Atthar M', 'Ralin Zapenia',
            'Toni Pratama', 'Malik A'
        ];

        // Gabungkan semua dan map dengan divisinya
        $allEmployees = [];

        foreach ($unitPersonnel as $name) {
            $allEmployees[] = ['name' => $name, 'division' => 'Unit'];
        }

        foreach ($wtpPersonnel as $name) {
            $allEmployees[] = ['name' => $name, 'division' => 'WTP'];
        }

        foreach ($ashFgdPersonnel as $name) {
            $allEmployees[] = ['name' => $name, 'division' => 'Ash FGD'];
        }

        // Hilangkan duplikat berdasarkan nama
        $uniqueEmployees = collect($allEmployees)->unique('name')->values();

        $shifts = [1, 2, 3]; // shift_id
        $startDate = Carbon::now()->startOfWeek(); // Senin minggu ini
        $schedules = [];

        foreach ($uniqueEmployees as $index => $emp) {
            $employee = DB::table('employees')->where('name', $emp['name'])->first();

            if (!$employee) continue;

            for ($i = 0; $i < 3; $i++) {
                $schedules[] = [
                    'employee_id' => $employee->id,
                    'shift_id' => $shifts[$i],
                    'date' => $startDate->copy()->addDays(($index + $i) % 7)->setTime([7, 15, 23][$i], 0),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('schedules')->insert($schedules);
    }
}
