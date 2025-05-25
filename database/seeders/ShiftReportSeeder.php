<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShiftReportSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('shift_reports')->insert([
            [
                'employee_id' => 1,
                'from_shift_id' => 1,
                'to_shift_id' => 2,
                'title' => 'Pergantian Shift Pagi ke Siang',
                'description' => 'Serah terima tugas berjalan lancar, tidak ada kendala berarti.',
                'time' => Carbon::now()->subDays(1)->setTime(15, 0),
                'address' => 'Pabrik A, Jl. Industri No. 5, Bekasi',
                'image' => 'shift_reports/report1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 2,
                'from_shift_id' => 2,
                'to_shift_id' => 3,
                'title' => 'Shift Siang ke Malam',
                'description' => 'Perlu perhatian di mesin 3, sedikit gangguan teknis saat operasional.',
                'time' => Carbon::now()->subDays(2)->setTime(23, 0),
                'address' => 'Pabrik A, Jl. Industri No. 5, Bekasi',
                'image' => 'shift_reports/report2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 1,
                'from_shift_id' => 1,
                'to_shift_id' => 3,
                'title' => 'Shift Pagi ke Malam',
                'description' => 'Tidak ada masalah, semua berjalan sesuai rencana.',
                'time' => Carbon::now()->subDays(3)->setTime(20, 0),
                'address' => 'Pabrik A, Jl. Industri No. 5, Bekasi',
                'image' => 'shift_reports/report3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
