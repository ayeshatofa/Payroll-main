<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = ['All', 'Department of Computer Science & Engineering', 'Department of Electrical & Electronic Engineering',
                        'Department of Civil Engineering', 'Department of Mathematics',
                        ];

        for($i = 0; $i < sizeof($departments); $i++)
        {
            $dep_name = $departments[$i];
            DB::table('departments')->insert([
                'dep_name' => $dep_name,  
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
