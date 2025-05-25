<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShiftChangeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('shift_changes')->insert([
            [
                'shift_report_id' => 1,
                'approved_by' => 1, // ID dari shift_leaders
                'status' => 'approved',
                'approved_at' => Carbon::now()->subHours(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shift_report_id' => 2,
                'approved_by' => 2, // ID dari shift_leaders
                'status' => 'rejected',
                'approved_at' => Carbon::now()->subHours(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shift_report_id' => 3,
                'approved_by' => 2,
                'status' => 'pending',
                'approved_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
