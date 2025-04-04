<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Position;
use App\Models\User;
use App\Models\Bonus;
use App\Models\Deduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
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
        $salaries = DB::table('salaries')->get();
        return view('salary.index')->with('salaries', $salaries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allPositions = Position::pluck('name')->toArray(); // Get all positions from the Position table
        $usedPositions = Salary::pluck('position')->toArray(); // Get all stored JSON positions

        // Convert JSON-encoded positions to an array
        $usedPositions = collect($usedPositions)->flatMap(function ($item) {
            return json_decode($item, true); // Convert JSON string to an array
        })->unique()->toArray();

        // Get positions that are NOT in usedPositions
        $positions = array_diff($allPositions, $usedPositions);
        return view('salary.create', compact('positions'));
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
            'basic_salary' => 'required|numeric|min:0',
            'allowance' => 'required|numeric|min:0',
            'tax_rate' => 'required|numeric|min:0',
            'grade' => 'required|numeric|min:0',
            'position' => 'required|', // Ensures it's an array
        ]);

        $gradeExists = Salary::where('grade', $request->grade)->exists();

        if ($gradeExists) {
            return redirect()->route('salary.create')->with('msg', 'Grade already exists. If you want to update it, go to edit.');
        }     
        
        $salaries = Salary::create([
            'basic_salary' => $request->basic_salary,
            'allowance' => $request->allowance,
            'tax_rate' => $request->tax_rate,
            'grade' => $request->grade,
            'position' => json_encode($request->position),
            'total_salary' => ((float) $request->basic_salary + (float) $request->allowance)
        ]);    
 
        return redirect()->route('salary.index')->with('msg', 'Salary created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('salary.show')->with('salary',$salary);
        $salary = Salary::findOrFail($id);
        $users = User::where('grade', $salary->grade)->get();
 
        return view('salary.show', compact('salary', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $salary)
    {
        $positions = Position::pluck('name');
        return view('salary.edit')->with('salary',$salary)->with('positions', $positions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salary $salary)
    {
        $request->validate([
            'basic_salary' => 'required|numeric|min:0',
            'allowance' => 'required|numeric|min:0',
            'tax_rate' => 'required|numeric|min:0',
        ]);

        $salaries = DB::table('salaries')->where('salary_id', $salary->salary_id)->update([
            'basic_salary' => $request->basic_salary,
            'allowance' => $request->allowance,
            'tax_rate' => $request->tax_rate,
            'total_salary' => ((float) $request->basic_salary + (float) $request->allowance)
        ]);
        
        return redirect()->route('salary.index')->with('msg', 'Salary updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salary $salary)
    {
        DB::table('salaries')->where('salary_id',$salary->salary_id)->delete();
        return redirect()->route('salary.index')->with('msg', 'Salary removed successfully');
    }
}
