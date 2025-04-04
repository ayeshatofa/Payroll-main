<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\LeaveEmail;
use Illuminate\Support\Facades\Mail;

class AdminAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now()->toDateString();

        $users = User::where('role', '!=', 'admin')->get();

        $attendanceStatuses = [];

        foreach ($users as $user) {
            $attendance = Attendance::where('user_id', $user->id)
                                    ->where('date', $today)
                                    ->first();  

            if ($attendance) {
                $attendanceStatuses[] = [
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'status' => $attendance->status,
                ];
            } else {
                $attendanceStatuses[] = [
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'status' => 'No Record',
                ];
            }
        }

        return view('admin_attendance.index', compact('attendanceStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin_attendance.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
    
        $user_id = $id; 
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
    
        while ($startDate->lte($endDate)) {
            // Check if it's already marked (prevent duplicate entries)
            $existingAttendance = Attendance::where('user_id', $user_id)
                ->whereDate('date', $startDate->toDateString())
                ->first();
    
            if (!$existingAttendance) {
                
                Attendance::create([
                    'user_id' => $user_id,
                    'date' => $startDate->toDateString(),
                    'status' => 'Leave',
                    'month' => $startDate->format('F')
                ]);
            }
    
            $startDate->addDay(); // Move to the next day
        }
        $user = User::find($user_id);
        // $to = $user->email;
        $to = "ayeshasultanatofa398@gmail.com";
        Mail::to($to)->send(new LeaveEmail($user, $startDate, $endDate));
    
        return redirect()->back()->with('success', 'Leave marked successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
