<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;

class MarkAbsentees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:mark-absent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark employees as absent if they have not checked in today.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::now()->toDateString();
        $currentMonth = Carbon::now()->format('F');
        $users = User::where('role', '!=', 'admin') 
                    ->whereDoesntHave('attendances', function ($query) use ($today) {
                        $query->whereDate('date', $today)
                              ->where('status', '!=', 'Leave')
                              ->where('status', '!=', 'Holiday');
                    })
                    ->get();
        
        $isHoliday = Carbon::now()->isThursday() || Carbon::now()->isFriday();

        foreach ($users as $user) {
            $status = $isHoliday ? 'Holiday' : 'Absent';
            Attendance::create([
                'user_id' => $user->id,
                'date' => $today,
                'status' => $status,
                'month' => $currentMonth
            ]);
        }



        $this->info('Absentees marked successfully.');
    }
}
