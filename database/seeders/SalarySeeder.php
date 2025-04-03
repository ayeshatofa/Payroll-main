<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $salary_grades = [
            ['grade' => 1, 'basic_salary' => 178000, 'allowance' => 15000, 'total_salary' => (178000+15000), 'tax_rate' => 10, 'position' => json_encode(['VC'])],
            ['grade' => 2, 'basic_salary' => 170000, 'allowance' => 15000, 'total_salary' => (170000+15000), 'tax_rate' => 10, 'position' => json_encode(['Pro VC'])],
            ['grade' => 3, 'basic_salary' => 160000, 'allowance' => 14000, 'total_salary' => (160000+14000), 'tax_rate' => 9, 'position' => json_encode(['Registerer', 'Treasurer'])],
            ['grade' => 4, 'basic_salary' => 150000, 'allowance' => 13000, 'total_salary' => (150000+13000), 'tax_rate' => 9, 'position' => json_encode(['Dean'])],
            ['grade' => 5, 'basic_salary' => 130000, 'allowance' => 13000, 'total_salary' => (130000+13000), 'tax_rate' => 8, 'position' => json_encode(['Chairman'])],
            ['grade' => 6, 'basic_salary' => 115000, 'allowance' => 12000, 'total_salary' => (115000+12000), 'tax_rate' => 7, 'position' => json_encode(['Professor'])],
            ['grade' => 7, 'basic_salary' => 100000, 'allowance' => 11000, 'total_salary' => (100000+11000), 'tax_rate' => 7, 'position' => json_encode(['Associate Professor'])],
            ['grade' => 8, 'basic_salary' => 80000, 'allowance' => 10000, 'total_salary' => (80000+10000), 'tax_rate' => 6, 'position' => json_encode(['Assistant Professor'])],
            ['grade' => 9, 'basic_salary' => 50000, 'allowance' => 8000, 'total_salary' => (50000+8000), 'tax_rate' => 5, 'position' => json_encode(['Lecturer'])],
            ['grade' => 10, 'basic_salary' => 30000, 'allowance' => 5000, 'total_salary' => (30000+5000), 'tax_rate' => 4, 'position' => json_encode(['Senior Staff'])],
            ['grade' => 11, 'basic_salary' => 15000, 'allowance' => 3000, 'total_salary' => (15000+3000), 'tax_rate' => 3, 'position' => json_encode(['Junior Staff'])],
        ];

        foreach ($salary_grades as $grade) {
            DB::table('salaries')->insert([
                'grade' => $grade['grade'],
                'basic_salary' => $grade['basic_salary'],
                'allowance' => $grade['allowance'],
                'total_salary' => $grade['total_salary'],
                'tax_rate' => $grade['tax_rate'],
                'position' => $grade['position'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
