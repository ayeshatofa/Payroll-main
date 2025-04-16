<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Bonus;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BonusController extends Controller
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
        $bonuses = DB::table('bonuses')->get();
        return view('bonus.index')->with('bonuses', $bonuses);
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
        return view('bonus.create', compact('grades'));
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
            'name' => 'required|string',
            'bonusType' => 'required',
            'rate' => 'required',
            'month' => 'required|array',
            'gradeNumbers' => 'required|array', // Ensures it's an array
            'gradeNumbers.*' => 'numeric',
        ]);

        $bonus = Bonus::create([
            'name' => $request->name,
            'bonusType' => $request->bonusType,
            'rate' => $request->rate,
            'month' => json_encode($request->month),
            'gradeNumbers' => json_encode($request->gradeNumbers), 
        ]);

        // Find all users whose grade exists in the gradeNumbers array of the bonus
        $eligibleUsers = User::whereIn('grade', $request->gradeNumbers)->get();

        // Attach the new bonus to all eligible users in the users_bonuses table
        foreach ($eligibleUsers as $user) {
            $user->bonuses()->attach([
                $bonus->id => ['month' => json_encode($request->month)]
            ]);
        }

        return redirect()->route('bonus.index')->with('msg', 'Bonus created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bonus = Bonus::findOrFail($id);
        $users = $bonus->users()->where('bonus_id', $bonus->id)->get();
 
        return view('bonus.show', compact('bonus', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Bonus $bonus)
    {
        $grades = Salary::pluck('grade');
        return view('bonus.edit')->with('bonus', $bonus)->with('grades', $grades);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bonus $bonus)
    {
        $request->validate([
            'name' => 'required|string',
            'bonusType' => 'required',
            'rate' => 'required',
            'month' => 'required|array',
            'gradeNumbers' => 'required|array', // Ensures it's an array
            'gradeNumbers.*' => 'numeric',
        ]);

        $months = $request->bonusType == 'Monthly' ? ['Every'] : $request->month;
        // Update the bonus
        $bonus->update([
            'name' => $request->name,
            'bonusType' => $request->bonusType,
            'month' => json_encode($months),
            'rate' => $request->rate,
            'gradeNumbers' => json_encode($request->gradeNumbers),
        ]);

        DB::table('users_bonuses')->where('bonus_id', $bonus->id)->delete();
        
        // Find all users whose grade exists in the gradeNumbers array of the bonus
        $eligibleUsers = User::whereIn('grade', $request->gradeNumbers)->get();

        // Attach the new bonus to all eligible users in the users_bonuses table
        foreach ($eligibleUsers as $user) {
            $user->bonuses()->sync([
                $bonus->id => ['month' => json_encode($request->month)]
            ]);
        }

        return redirect()->route('bonus.index')->with('msg', 'Bonus edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bonus $bonus)
    {
        DB::table('bonuses')->where('id',$bonus->id)->delete();
        return redirect()->route('bonus.index')->with('msg', 'Bonus removed successfully');
    }
}
