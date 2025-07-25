<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShiftSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('shifts')->insert([
            [
                'name' => 'Shift Pagi',
                'group' => 'Unit Personnel',
                'start_time' => Carbon::createFromTime(7, 0, 0),
                'end_time' => Carbon::createFromTime(15, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Shift Sore',
                'group' => 'Ash FGD Personnel',
                'start_time' => Carbon::createFromTime(15, 0, 0),
                'end_time' => Carbon::createFromTime(23, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Shift Malam',
                'group' => 'WTP Personnel',
                'start_time' => Carbon::createFromTime(23, 0, 0),
                'end_time' => Carbon::createFromTime(7, 0, 0)->addDay(), // lewat tengah malam
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
