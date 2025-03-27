<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BonusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bonuses = [
            [
                'name' => 'Performance Bonus',
                'bonusType' => 'Half-yearly',
                'rate' => 10,
                'gradeNumbers' => json_encode(['3', '4', '5', '6', '7', '8', '9']),
                'month' => json_encode(['January', 'July']),
            ],
            [
                'name' => 'Year-End Bonus',
                'bonusType' => 'Annually',
                'rate' => 7,
                'gradeNumbers' => json_encode(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11']),
                'month' => json_encode(['December']),
            ],
            [
                'name' => 'Eid-ul-Fitur',
                'bonusType' => 'Annually',
                'rate' => 15,
                'gradeNumbers' => json_encode(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11']),
                'month' => json_encode(['March']),
            ],
            [
                'name' => 'Eid-ul-Ajha',
                'bonusType' => 'Annually',
                'rate' => 15,
                'gradeNumbers' => json_encode(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11']),
                'month' => json_encode(['July']),
            ],
            [
                'name' => 'Executive Bonus',
                'bonusType' => 'Monthly',
                'rate' => 5,
                'gradeNumbers' => json_encode(['1', '2', '3', '4']),
                'month' => json_encode(['Every']),
            ],
            [
                'name' => 'Taeching Bonus',
                'bonusType' => 'Monthly',
                'rate' => 3,
                'gradeNumbers' => json_encode(['4', '5', '6', '7', '8', '9']),
                'month' => json_encode(['Every']),
            ],
        ];

        foreach ($bonuses as $bonus) {
            DB::table('bonuses')->insert([
                'name' => $bonus['name'],
                'bonusType' => $bonus['bonusType'],
                'rate' => $bonus['rate'],
                'gradeNumbers' => $bonus['gradeNumbers'],
                'month' => $bonus['month'],
            ]);
        }
    }
}
