<?php

namespace Database\Seeders;

use App\Models\ShiftChange;
use Illuminate\Database\Seeder;

class ShiftChangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reportsData = [
            [
                'shift_report_id' => 1,
                'approved_by' => 1,
                'status' => 'rejected',
                'approved_at' => now(),
            ],
            [
                'shift_report_id' => 2,
                'approved_by' => 2,
                'status' => 'approved',
                'approved_at' => now(),
            ],
        ];

        foreach ($reportsData as $report) {
            ShiftChange::create($report);
        }
    }
}
