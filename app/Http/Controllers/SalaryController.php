<?php

namespace App\Http\Controllers;

use App\Models\Salary;
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
        return view('salary.create');
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
        ]);

        $salaries = Salary::create([
            'basic_salary' => $request->basic_salary,
            'allowance' => $request->allowance,
            'tax_rate' => $request->tax_rate,
            'grade' => $request->grade,
            'total_salary' => ((float) $request->basic_salary + (float) $request->allowance)
        ]);    
 
        return redirect()->route('salary.index')->with('msg', 'Employee updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(Salary $salary)
    {
        return view('salary.show')->with('salary',$salary);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $salary)
    {
        return view('salary.edit')->with('salary',$salary);
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
            'grade' => 'required|numeric|min:0',
        ]);
        $salaries = DB::table('salaries')->where('salary_id', $salary->salary_id)->update([
            'basic_salary' => $request->basic_salary,
            'allowance' => $request->allowance,
            'tax_rate' => $request->tax_rate,
            'grade' => $request->grade,
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
