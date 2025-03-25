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
        DB::table('salaries')->insert([
            [
                'basic_salary' => 78000,
                'allowance' => 15000,
                'total_salary' => 78000+15000,
                'grade' => 1,
                'tax_rate' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'basic_salary' => 70000,
                'allowance' => 13000,
                'total_salary' => (70000+13000),
                'grade' => 2,
                'tax_rate' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'basic_salary' => 78000,
                'allowance' => 15000,
                'total_salary' => (78000+15000),
                'grade' => 3,
                'tax_rate' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'basic_salary' => 78000,
                'allowance' => 15000,
                'total_salary' => (78000+15000),
                'grade' => 4,
                'tax_rate' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'basic_salary' => 58000,
                'allowance' => 11000,
                'total_salary' => (78000+15000),
                'grade' => 5,
                'tax_rate' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'basic_salary' => 78000,
                'allowance' => 15000,
                'total_salary' => (78000+15000),
                'grade' => 6,
                'tax_rate' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'basic_salary' => 78000,
                'allowance' => 15000,
                'total_salary' => (78000+15000),
                'grade' => 7,
                'tax_rate' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'basic_salary' => 78000,
                'allowance' => 15000,
                'total_salary' => (78000+15000),
                'grade' => 8,
                'tax_rate' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'basic_salary' => 78000,
                'allowance' => 15000,
                'total_salary' => (78000+15000),
                'grade' => 10,
                'tax_rate' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            

            
        ]);
    }
}
