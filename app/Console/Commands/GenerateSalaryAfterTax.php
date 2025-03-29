<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Payroll;
use App\Models\User;
use App\Models\Salary;
use App\Models\Tax;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GenerateSalaryAfterTax extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tax:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically generate salary after taxes for all employees every month';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $payrolls = Payroll::all();    // have to re-evalute this
        $currentMonth = Carbon::now()->format('F');
        $taxData = [];
        foreach($payrolls as $payroll)
        {
            $collectGrade = User::where('id', $payroll->user_id)->value('grade');
            $collectTaxRate = Salary::where('grade', $collectGrade)->value('tax_rate');
            $salaryBeforeTax = $payroll->payroll;
            $tax_amount = $salaryBeforeTax * ($collectTaxRate/100);
            $salaryAfterTax = $salaryBeforeTax - $tax_amount;
 
            $taxData[] = [
                'user_id' => $payroll->user_id,
                'payable_salary' => $salaryAfterTax,
                'tax_amount' => $tax_amount,
                'tax_rate' => $collectTaxRate,
                'month' => $currentMonth,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        if (!empty($taxData)) {
            Tax::insert($taxData);
            $this->info('Tax generated successfully for all employees.');
        } else {
            $this->info('No employees found for tax generation.');
        }
    }
}
