<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Get all department IDs
        $departments = DB::table('departments')->pluck('dep_id', 'dep_name')->toArray();

        $allDepId = $departments['All'] ?? null;
        $otherDepIds = array_diff($departments, [$allDepId]); 

        $positions = [
            'VC' => 1,
            'Pro VC' => 2,
            'Treasurer' => 3,
            'Registerer' => 3,
            'Dean' => 4,
            'Chairman' => 5,
            'Professor' => 6,
            'Associate Professor' => 7,
            'Assistant Professor' => 8,
            'Lecturer' => 9,
            'Senior Stuff' => 10,
            'Junior Stuff' => 11,
        ];

        foreach ($positions as $position => $grade) {
            if ($grade <= 3) {
                // Store one record with dep_id = "All"
                DB::table('users')->insert([
                    'name' => $faker->name(),
                    'email' => $faker->unique()->safeEmail(),
                    'password' => Hash::make($faker->password(8, 16)),
                    'address' => $faker->address(),
                    'position' => $position,
                    'grade' => $grade,
                    'dep_id' => $allDepId,
                    'date_of_join' => $faker->dateTimeBetween('2005-01-01', '2024-12-31')->format('Y-m-d'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } elseif ($grade == 4 || $grade == 5) {
                // Store one record for each department except "All"
                foreach ($otherDepIds as $depId) {
                    DB::table('users')->insert([
                        'name' => $faker->name(),
                        'email' => $faker->unique()->safeEmail(),
                        'password' => Hash::make($faker->password(8, 16)),
                        'address' => $faker->address(),
                        'position' => $position,
                        'grade' => $grade,
                        'dep_id' => $depId,
                        'date_of_join' => $faker->dateTimeBetween('2005-01-01', '2024-12-31')->format('Y-m-d'),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            } else {
                // Store 2 users for each department except "All"
                foreach ($otherDepIds as $depId) {
                    for ($i = 0; $i < 2; $i++) {
                        DB::table('users')->insert([
                            'name' => $faker->name(),
                            'email' => $faker->unique()->safeEmail(),
                            'password' => Hash::make($faker->password(8, 16)),
                            'address' => $faker->address(),
                            'position' => $position,
                            'grade' => $grade,
                            'dep_id' => $depId,
                            'date_of_join' => $faker->dateTimeBetween('2005-01-01', '2024-12-31')->format('Y-m-d'),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
    }
}
