<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        // Employee ID dibagi berdasarkan divisi:
        // Unit Personnel: ID 1 - 5
        // WTP Personnel: ID 6 - 10
        // Ash FGD Personnel: ID 11 - 15

        $schedules = [
           [
                'employee_id' => 1,
                'shift_id' => 1,
                'date' => Carbon::now()->startOfWeek()->addDays(1)->setTime(7, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 1,
                'shift_id' => 2,
                'date' => Carbon::now()->startOfWeek()->addDays(2)->setTime(15, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 2,
                'shift_id' => 3,
                'date' => Carbon::now()->startOfWeek()->addDays(2)->setTime(15, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 3,
                'shift_id' => 3,
                'date' => Carbon::now()->startOfWeek()->addDays(3)->setTime(23, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('schedules')->insert($schedules);
    }
}
