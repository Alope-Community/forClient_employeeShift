<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        // Asumsikan ada employee ID 1 dan 2, serta shift ID 1, 2, dan 3
        $schedules = [
            [
                'employee_id' => 1,
                'shift_id' => 1,
                'date' => Carbon::now()->subDays(2)->setTime(7, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 1,
                'shift_id' => 2,
                'date' => Carbon::now()->subDays(1)->setTime(15, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 2,
                'shift_id' => 3,
                'date' => Carbon::now()->setTime(23, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('schedules')->insert($schedules);
    }
}
