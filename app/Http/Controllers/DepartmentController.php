<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
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
        $departments = DB::table('departments')->get();
        return view('department.index')->with('departments', $departments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('department.create');
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
            'dep_name' => 'required|max:255',
        ]);
        $departments = DB::table('departments')->insert([
            'dep_name' => $request->dep_name,
            
        ]);
        return redirect()->route('department.index')->with('msg', 'Department updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view('department.show')->with('department',$department);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('department.edit')->with('department',$department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'dep_name' => 'required|max:255',
        ]);
        //$departments = DB::table('departments')->where('emp_id', $department->emp_id)->update([
            //'dep_name' => $request->dep_name,
        $departments = DB::table('departments')->where('dep_id', $department->dep_id)->update([
                'dep_name' => $request->dep_name,   
        ]);
        return redirect()->route('department.index')->with('msg', 'Department updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        DB::table('departments')->where('dep_id',$department->dep_id)->delete();
        return redirect()->route('department.index')->with('msg', 'Department removed successfully');
    }
}
