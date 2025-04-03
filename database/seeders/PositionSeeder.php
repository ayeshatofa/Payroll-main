<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $positions = ['VC', 'Pro VC', 'Treasurer',
                        'Registerer', 'Dean', 'Chairman', 'Professor', 'Associate Professor', 'Assistant Professor',
                        'Lecturer', 'Senior Staff', 'Junior Staff'
                        ];

        for($i = 0; $i < sizeof($positions); $i++)
        {
            $name = $positions[$i];
            DB::table('positions')->insert([
                'name' => $name,  
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
