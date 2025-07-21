<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $shifts = [1, 2, 3]; // shift_id
        $startDate = Carbon::now()->startOfDay(); // Mulai dari hari ini
        $totalWeeks = 8; // Total minggu yang akan diisi

        // Daftar nama per divisi
        $divisions = [
            'Unit' => [
                'Irsan F', 'Aldi I', 'Bambang P', 'M. Ardhika', 'Oktario', 'Reza P', 'Sepriando', 'Teguh S',
                'Aser F', 'Muhammad Aldi', 'Reksa S', 'Rudi A', 'Okki P', 'Muhammad Hafiizh', 'Recky',
                'Aldo F', 'Hardinata B', 'Julham C', 'Redho M', 'Satya A', 'Adam M', 'M Muarif', 'Adam E',
                'Harry A', 'Muhammad Peado', 'M Hawari', 'Rahmat F', 'Tomi A'
            ],
            'WTP' => [
                'Muhhamad Aldi', 'Reksa S', 'Syahru T', 'Olit R', 'M Ikhram', 'Tara dinata', 'Rendy F', 'Andi K',
                'Hardinata B', 'Julham C', 'Renaldi', 'Satya A', 'Aliando S', 'Wheny S', 'M Afgan', 'Inggit E',
                'Harianto A', 'M Padli', 'M Ahmad', 'Raisa F', 'Tonii A', 'Andhika P'
            ],
            'Ash FGD' => [
                'Tedi P', 'Aldi I', 'Prakoso A', 'M Lubi', 'Oktariansyah', 'Raditya', 'Suharman', 'Yazaman',
                'Afriansyah', 'Alif Kurniawan', 'M Aldiandi', 'Reksa S', 'Rudi A', 'Olish Zuhir', 'M Okii',
                'Burhanan', 'Rafli S', 'Aldo Paredo', 'Herlianto', 'Jumaidi', 'Rintan Anjani', 'Mario Teguh',
                'M Zaki', 'Agusudin', 'M Ilkhlas', 'Aidil', 'Rizky P', 'Qafi P', 'Atthar M', 'Ralin Zapenia',
                'Toni Pratama', 'Malik A'
            ],
        ];

        $schedules = [];

        for ($week = 0; $week < $totalWeeks; $week++) {
            for ($day = 0; $day < 7; $day++) {
                $currentDate = $startDate->copy()->addWeeks($week)->addDays($day);

                foreach ($divisions as $division => $names) {
                    // Ambil 3 nama secara bergilir
                    shuffle($names); // acak agar fair

                    $selectedNames = array_slice($names, 0, 3);

                    foreach ($shifts as $i => $shiftId) {
                        $employee = DB::table('employees')->where('name', $selectedNames[$i])->first();
                        if (!$employee) continue;

                        $schedules[] = [
                            'employee_id' => $employee->id,
                            'shift_id' => $shiftId,
                            'date' => $currentDate->copy()->setTime([7, 15, 23][$i], 0),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
            }
        }

        DB::table('schedules')->insert($schedules);
    }
}
