<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\User;
use App\Models\Deduction;
use Illuminate\Support\Facades\DB;

class DeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('admin'); // Only Admins can access
    }

    public function index()
    {
        $deductions = DB::table('deductions')->get();
        return view('deduction.index')->with('deductions', $deductions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = Salary::pluck('grade');
        // dd($grades);
        return view('deduction.create', compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rate' => 'required|numeric',
            'gradeNumbers' => 'nullable|array', // Can be null but must be an array if provided
            'gradeNumbers.*' => 'nullable|numeric', // Ensure each grade number is numeric
        ]);

        $deduction = Deduction::create([
            'name' => $request->name,
            'rate' => $request->rate,
            'gradeNumbers' => $request->has('gradeNumbers') ? json_encode($request->gradeNumbers) : null, 
        ]);

        if (!empty($request->gradeNumbers)) {
            $eligibleUsers = User::whereIn('grade', $request->gradeNumbers)->get();
        } else {
            $eligibleUsers = collect(); // Empty collection, no bonuses assigned 
        }
        
        // Attach the new bonus to all eligible users in the users_bonuses table
        foreach ($eligibleUsers as $user) {
            $user->deductions()->attach([$deduction->id]);
        }
        
        return redirect()->route('deduction.index')->with('msg', 'Deduction created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('deduction.show')->with('deductiont',$department);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Deduction $deduction)
    {
        $grades = Salary::pluck('grade');
        return view('deduction.edit')->with('deduction', $deduction)->with('grades', $grades);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deduction $deduction)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rate' => 'required|numeric',
            'gradeNumbers' => 'nullable|array', // Can be null but must be an array if provided
            'gradeNumbers.*' => 'nullable|numeric', // Ensure each grade number is numeric
        ]);

        // Update the deduction
        $deduction->update([
            'name' => $request->name,
            'rate' => $request->rate,
            'gradeNumbers' => $request->gradeNumbers ? json_encode($request->gradeNumbers) : null, // Convert to JSON
        ]);

        if (!empty($request->gradeNumbers) && !in_array(null, $request->gradeNumbers)) {
            // Proceed with attaching the deduction to eligible users with valid grade numbers
            $eligibleUsers = User::whereIn('grade', $request->gradeNumbers)->get();
            DB::table('user_deductions')->where('deduction_id', $deduction->id)->delete();
            
            foreach ($eligibleUsers as $user) {
                $user->deductions()->attach([$deduction->id]);
            }
        } 
        else {
            $eligibleUsers = collect(); // Empty collection, no bonuses assigned
        }
        return redirect()->route('deduction.index')->with('msg', 'Deduction updated successfully');
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
