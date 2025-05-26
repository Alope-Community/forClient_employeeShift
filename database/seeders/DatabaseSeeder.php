<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            EmployeeSeeder::class,
            ShiftLeaderSeeder::class,
            ShiftSeeder::class,
            ScheduleSeeder::class,
            ShiftReportSeeder::class,
            ShiftChangeSeeder::class,
            UserAdminSeeder::class,
        ]);
    }
}
