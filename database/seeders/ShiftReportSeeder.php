<?php

namespace Database\Seeders;

use App\Models\ShiftLeader;
use App\Models\ShiftReport;
use App\Notifications\ShiftReportNotification;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ShiftReportSeeder extends Seeder
{
    public function run(): void
    {
        $reportsData = [
            [
                'from_employee_id' => 1,
                'employee_id' => 1,
                'from_shift_id' => 1,
                'to_shift_id' => 2,
                'title' => 'Pergantian Shift Pagi ke Siang',
                'description' => 'Serah terima tugas berjalan lancar, tidak ada kendala berarti.',
                'time' => Carbon::now()->subDays(1)->setTime(15, 0),
                'address' => 'Pabrik A, Jl. Industri No. 5, Bekasi',
                'image' => 'shift_reports/report1.jpg',
            ],
            [
                'from_employee_id' => 2,
                'employee_id' => 2,
                'from_shift_id' => 2,
                'to_shift_id' => 3,
                'title' => 'Shift Siang ke Malam',
                'description' => 'Perlu perhatian di mesin 3, sedikit gangguan teknis saat operasional.',
                'time' => Carbon::now()->subDays(2)->setTime(23, 0),
                'address' => 'Pabrik A, Jl. Industri No. 5, Bekasi',
                'image' => 'shift_reports/report2.jpg',
            ],
        ];

        $shiftLeaders = ShiftLeader::all();

        foreach ($reportsData as $data) {
            $timestamp = now();

            $shiftReport = ShiftReport::create(array_merge($data, [
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]));

            $shiftReport->shiftChange()->create([
                'status' => 'pending',
                'approved_by' => null,
                'approved_at' => null,
            ]);

            foreach ($shiftLeaders as $shiftLeader) {
                $shiftLeader->notify(new ShiftReportNotification(
                    $shiftReport->id,
                    'Seeder System',
                    $shiftReport->time,
                    $shiftReport->description
                ));
            }
        }
    }
}
