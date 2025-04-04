<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Payroll;
use App\Models\User;
use App\Models\Salary;
use App\Models\Bonus;
use App\Models\Deduction;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GenerateMonthlyPayroll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payroll:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically generate payroll for all employees every month';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::where('role', '!=', 'admin')->get();
        $payrollData = [];
        $currentMonth = Carbon::now()->format('F');
        $preMonth = Carbon::now()->subMonth()->format('F');
        $daysInMonth = Carbon::now()->daysInMonth;
        foreach ($users as $user) {
            $attendanceCount = Attendance::where('user_id', $user->id)
                                        ->where('month', $preMonth)
                                        ->where('status', 'Absent')
                                        ->count();
            $lateCount = Attendance::where('user_id', $user->id)
                                        ->where('month', $preMonth)
                                        ->where('status', 'Late')
                                        ->count();
            $total_attended = $daysInMonth - $attendanceCount;
            $salary = Salary::where('grade', $user->grade)->value('total_salary');
            $monthly_bonus = DB::table('users_bonuses')
                            ->join('bonuses', 'users_bonuses.bonus_id', '=', 'bonuses.id') // Joining the bonuses table
                            ->where('users_bonuses.user_id', $user->id)
                            ->where('bonuses.bonusType', 'Monthly') // Filtering by bonus type
                            ->sum('bonuses.rate'); // Summing up all yearly bonuses
            $half_yearly_bonus = 0;
            $half_yearly_bonus = DB::table('users_bonuses')
                            ->join('bonuses', 'users_bonuses.bonus_id', '=', 'bonuses.id') // Joining the bonuses table
                            ->where('users_bonuses.user_id', $user->id)
                            ->where('bonuses.bonusType', 'Half-yearly') // Filtering by bonus type
                            ->whereJsonContains('users_bonuses.month', $currentMonth) // Ensuring it applies in the right month
                            ->sum('bonuses.rate'); // Summing up all yearly bonuses
            $yearly_bonus = 0;
            $yearly_bonus = DB::table('users_bonuses')
                            ->join('bonuses', 'users_bonuses.bonus_id', '=', 'bonuses.id') // Joining the bonuses table
                            ->where('users_bonuses.user_id', $user->id)
                            ->where('bonuses.bonusType', 'Annually') // Filtering by bonus type
                            ->whereJsonContains('users_bonuses.month', $currentMonth) // Ensuring it applies in the right month
                            ->sum('bonuses.rate'); // Summing up all yearly bonuses

            $bonusRate = $monthly_bonus + $half_yearly_bonus + $yearly_bonus;
            $bonus = $salary * ($bonusRate/100);
            $deductionRate = DB::table('user_deductions')
                            ->join('deductions', 'user_deductions.deduction_id', '=', 'deductions.id') // Joining the bonuses table
                            ->where('user_deductions.user_id', $user->id)  // Ensuring it applies in the right month
                            ->sum('deductions.rate');
            $deduction = $salary * ($deductionRate/100);
            $fine = 0;
            if($attendanceCount > 3)
            {
                $fine = $attendanceCount - 3;
                $fine *= 500;
            }
            $fine += ($lateCount * 100);
            $payroll = $salary + $bonus - $deduction - $fine;

            $payrollData[] = [
                'user_id' => $user->id,
                'salary' => $salary,
                'bonus' => $bonus,
                'deduction' => $deduction,
                'fine' => $fine,
                'payroll' => $payroll,
                'month' => $currentMonth,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($payrollData)) {
            Payroll::insert($payrollData);
            $this->info('Payroll generated successfully for all employees.');
        } else {
            $this->info('No employees found for payroll generation.');
        }
    }
}
