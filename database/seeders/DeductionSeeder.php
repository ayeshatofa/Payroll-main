<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deductions = [
            [
                'name' => 'Lunch',
                'rate' => 5, 
                
            ],
            [
                'name' => 'Provident Fund',
                'rate' => 5, 
                'gradeNumbers' => json_encode(['2', '3', '4', '5', '6']), 
            ],
            [
                'name' => 'Health Insurance',
                'rate' => 3, 
                'gradeNumbers' => json_encode(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11']), 
            ],
            [
                'name' => 'House rent',
                'rate' => 10, 
                'gradeNumbers' => json_encode(['1', '2', '3', '4']), 
            ],
            [
                'name' => 'Transport',
                'rate' => 10, 
                'gradeNumbers' => null,
            ],
        ];

        foreach ($deductions as $deduction) {
            DB::table('deductions')->insert([
                'name' => $deduction['name'],
                'rate' => $deduction['rate'],
                'gradeNumbers' => $deduction['gradeNumbers'],
            ]);
        }
    }
}
