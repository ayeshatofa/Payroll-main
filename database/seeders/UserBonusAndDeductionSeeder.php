<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Deduction;
use App\Models\Bonus;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class UserBonusAndDeductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) { 

            // ✅ Fetch bonuses matching user's grade
            $bonusRecords = $user->grade !== null
                ? Bonus::whereJsonContains('gradeNumbers', (string) $user->grade)->get()
                : collect(); 
            $bonusData = [];
            foreach ($bonusRecords as $record) {
                $bonusData[$record->id] = ['month' => $record->month]; 
            }
            // ✅ Attach bonuses only if records exist
            if (!empty($bonusData)) {
                $user->bonuses()->attach($bonusData);
            }


            // for user_deductions table
            $records = $user->grade !== null
            ? Deduction::whereJsonContains('gradeNumbers', (string) $user->grade)->get()
            : collect(); 
    
            // Attach all deduction records to the user
            foreach ($records as $record) {
                $user->deductions()->attach($record->id);
            }
            
            $nullDeductions = Deduction::whereNull('gradeNumbers')->get();

            if ($nullDeductions->isNotEmpty()) {
                $randomDeduction = $nullDeductions->random(); // Pick one randomly
                $user->deductions()->syncWithoutDetaching($randomDeduction->id);
            }
        }
    }
}
