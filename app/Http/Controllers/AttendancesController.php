<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendancesController extends Controller
{
    public function create()
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->where('date', now()->toDateString())
            ->first();
        return view('attendances.create', compact('attendance'));
    }

    // Handle Check-In
    public function store(Request $request)
    {
        if (Carbon::now()->isThursday() || Carbon::now()->isFriday()) {
            Attendance::create([
                'user_id' => Auth::id(),
                'date' => Carbon::now()->toDateString(),
                'month' => Carbon::now()->format('F'),
                'status' => 'Holiday'
            ]);
            return redirect()->back()->with('success', 'You cannot give attendance on a holiday!');
        }
        $existingAttendanceLeave = Attendance::where('user_id', Auth::id())
                    ->where('date', now()->toDateString())
                    ->where('status', 'Leave')
                    ->first();
        if ($existingAttendanceLeave) {
            return redirect()->back()->with('success', 'You cannot give attendance on a leave!');
        }
        $existingAttendance = Attendance::where('user_id', Auth::id())
            ->where('date', now()->toDateString())
            ->first();

        if ($existingAttendance) {
            if (!$existingAttendance->check_in_time) {
                // If check-in time is missing, set it
                $existingAttendance->update(['check_in_time' => now()->toTimeString()]);
                return redirect()->back()->with('success', 'Check-in recorded!');
            } elseif (!$existingAttendance->check_out_time) {
                // If check-out time is missing, set it
                $existingAttendance->update(['check_out_time' => now()->toTimeString()]);
                return redirect()->back()->with('success', 'Check-out recorded!');
            } else {
                return redirect()->back()->with('error', 'You have already checked in and out today.');
            }
        } else {
            $check_in_time = now()->toTimeString(); // Gets the current time as a string
            $currentMonth = Carbon::now()->format('F');
            
            $status = 'Present';
            
            // Convert check-in time to a Carbon instance before comparing
            if (Carbon::parse($check_in_time)->greaterThan(Carbon::createFromTime(9, 0))) {
                $status = 'Late';
            }            
            Attendance::create([
                'user_id' => Auth::id(),
                'date' => now()->toDateString(),
                'check_in_time' => $check_in_time,
                'month' => $currentMonth,
                'status' => $status
            ]);
            return redirect()->back()->with('success', 'Check-in recorded!');
        }
    }
}

    
