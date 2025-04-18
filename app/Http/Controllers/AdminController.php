<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bonus;
use App\Models\Deduction;
use App\Models\Salary;
use App\Models\Position;
use App\Models\Department;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
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
        $userCount = User::where('role', '!=', 'admin')->count();
        return view('admin.index', compact('userCount'));
    }

    public function indexAdmin()
    {
        $feedbacks = Feedback::with('user:id,name')->latest()->get();
        return view('feedback.indexAdmin', compact('feedbacks'));
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
        $positions = Position::all();
        $user = User::find($id);
        $departments = Department::all();
        return view('admin.edit')->with('user', $user)->with('positions', $positions)->with('departments', $departments);
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

        $grade = Salary::whereJsonContains('position', $request->position)->value('grade');

        // dd($grade);

        // $grade = match ($request->position) {
        //     'VC' => 1,
        //     'Pro VC' => 2,
        //     'Treasurer', 'Registerer' => 3,
        //     'Dean' => 4,
        //     'Chairman' => 5,
        //     'Professor' => 6,
        //     'Associate Professor' => 7,
        //     'Assistant Professor' => 8,
        //     'Lecturer' => 9,
        //     'Senior Staff' => 10,
        //     'Junior Staff' => 11,
        //     default => null, // Handle unexpected values
        // };

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
        // dd($bonusData);
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
        $departments = Department::all();
        $positions = Position::all();
        return view('admin.search', compact(['users', 'departments', 'positions']));
    }
    public function autocomplete(Request $request)
    {
        $term = $request->input('term');
        
        $users = User::where('role', '!=', 'admin')
                    ->where('name', 'LIKE', '%'.$term.'%')
                    ->take(10)
                    ->get();
        
        $formattedUsers = $users->map(function($user) {
            return [
                'label' => $user->name,
                'value' => $user->name
            ];
        });
        
        return response()->json($formattedUsers);
    }
    public function searchForm(Request $request)
    {
        $users = User::with('departments') // Eager load relationship
            ->where('role', '<>', 'admin') // Exclude admins in query
            ->when($request->name, function ($query, $name) {
                return $query->where('name', 'LIKE', "%$name%");
            })
            ->when($request->department, function ($query, $department) {
                return $query->where('dep_id', $department);
            })
            ->when($request->position, function ($query, $position) {
                return $query->where('position', $position);
            })
            ->when($request->date_of_join, function ($query, $date) {
                return $query->whereDate('date_of_join', '>=', $date);
            })->get(); 
        
        return view('admin.view', [
            'users' => $users,
            'departments' => Department::all(), // Pass departments
            'positions' => Position::all() // Pass positions
        ]);
    }
}