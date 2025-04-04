<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

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

                if ($date->isThursday() || $date->isFriday()) {
                    DB::table('attendances')->insert([
                        'user_id' => $userId,
                        'date' => $date->toDateString(),
                        'month' => $month,
                        'status' => 'Holiday', // Mark as Holiday
                        'check_in_time' => null,
                        'check_out_time' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    continue; // Skip the rest of the loop for Thursday/Friday
                }

                // Make 'Present' more likely (70%), while others share 30%
                $statusPool = array_merge(
                    array_fill(0, 7, 'Present'),  // 70% chance
                    array_fill(0, 2, 'Late'),     // 20% chance
                    array_fill(0, 1, 'Absent'),   // 5% chance
                    array_fill(0, 1, 'Leave')     // 5% chance
                );
                $status = $statusPool[array_rand($statusPool)];

                // Set check-in/check-out times based on status
                if ($status === 'Present') {
                    $checkInTime = Carbon::parse('09:00:00')->subMinutes(rand(1, 15)); // Always before 9:00
                    $checkOutTime = Carbon::parse('17:00:00')->addMinutes(rand(-30, 30)); // Slight variation
                } elseif ($status === 'Late') {
                    $checkInTime = Carbon::parse('09:00:00')->addMinutes(rand(1, 60)); // Always after 9:00
                    $checkOutTime = Carbon::parse('17:00:00')->addMinutes(rand(-30, 30));
                } else {
                    // 'Absent' or 'Leave' means no check-in or check-out time
                    $checkInTime = null;
                    $checkOutTime = null;
                }

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
