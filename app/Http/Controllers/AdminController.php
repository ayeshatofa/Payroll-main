<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bonus;
use App\Models\Deduction;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
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
        return view('admin.edit')->with('user', $user);
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
            'position' => ['required', 'string'],
        ]);

        $grade = match ($request->position) {
            'VC' => 1,
            'Pro VC' => 2,
            'Treasurer', 'Registerer' => 3,
            'Dean' => 4,
            'Chairman' => 5,
            'Professor' => 6,
            'Associate Professor' => 7,
            'Assistant Professor' => 8,
            'Lecturer' => 9,
            'Senior Staff' => 10,
            'Junior Staff' => 11,
            default => null, // Handle unexpected values
        };

        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        DB::table('users')->where('id', $id)->update([
            'position' => $request->position,  
            'grade' => $grade, 
        ]);

        $records = $grade !== null
            ? Bonus::whereJsonContains('gradeNumbers', (string) $grade)->get()
            : collect(); 

        $bonusData = [];
        foreach ($records as $record) {
            $bonusData[$record->id] = ['month' => $record->month]; 
        }
        
        $user->bonuses()->sync($bonusData); 
 
        // for deduction
        $deductionIds = DB::table('user_deductions')
                          ->where('user_id', $user->id)
                          ->pluck('deduction_id')
                          ->toArray();
        
        $deductionsWithNullGrade = Deduction::whereIn('id', $deductionIds)
                                            ->whereNull('gradeNumbers')
                                            ->pluck('id')
                                            ->toArray();

        $records = $user->grade !== null
        ? Deduction::whereJsonContains('gradeNumbers', (string) $user->grade)->get()
        : collect(); 

        // Attach all deduction records to the user
        $deduction_ids = [];
        foreach ($records as $record) {
            $deduction_ids[] = $record->id;
        }
        
        // $deduction_ids = $deductionsWithNullGrade->pluck('id')->toArray();  // Only pluck 'id' from deductions with null gradeNumbers
        $deduction_ids = array_merge($deductionsWithNullGrade, $records->pluck('id')->toArray());      
        // dd($deduction_ids);
        $user->deductions()->sync($deduction_ids);
        return redirect()->route('admin.search')->with('msg', 'User updated successfully');
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('admin.search')->with('error', 'User deleted successfully');
    }
    public function search()
    {
        $users = User::with('departments')->latest()->take(10)->get();
        return view('admin.search', compact('users'));
    }
}
