<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::pluck('id'); // Fetch all user IDs

        foreach ($users as $userId) {
            for ($i = 1; $i <= 30; $i++) { // Seed for a month
                $date = Carbon::now()->subDays($i);
                $month = Carbon::now()->subMonth()->format('F');

                $status = ['Present', 'Absent', 'Late'][rand(0, 2)];

                $checkInTime = $status !== 'Absent' ? Carbon::parse('09:00:00')->addMinutes(rand(0, 60)) : null;
                $checkOutTime = $status !== 'Absent' ? Carbon::parse('17:00:00')->addMinutes(rand(-30, 30)) : null;

                DB::table('attendances')->insert([
                    'user_id' => $userId,
                    'date' => $date->toDateString(),
                    'month' => $month,
                    'status' => $status,
                    'check_in_time' => $checkInTime,
                    'check_out_time' => $checkOutTime,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
