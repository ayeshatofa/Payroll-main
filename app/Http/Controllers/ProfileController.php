<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bonus;
use App\Models\Deduction;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user(); 
        $deductions = Deduction::where(function ($query) {
            $query->whereNull('gradeNumbers')
                  ->orWhere('gradeNumbers', '[null]'); // Check if JSON is empty array
        })->get(); 
        return view('profile.edit', compact(['user', 'deductions'])); // Assuming 'user.edit' is the view to edit user info
    }

    public function update(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => ['required', 'string'],
            'position' => ['required', 'string'],
        ]);
        $user = auth()->user(); 
        $grade = match ($request->position) {
            'Professor' => 1,
            'Associate Professor' => 2,
            'Assistant Professor' => 3,
            'Lecturer' => 4,
            default => null, // Handle unexpected values
        };

        $user->update([
            'name' => $request->name,
            'address' => $request->address,
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
        

        $records = $grade !== null
        ? Deduction::whereJsonContains('gradeNumbers', (string) $grade)->get()
        : collect(); 

        // Attach all deduction records to the user
        $deduction_ids = [];
        foreach ($records as $record) {
            $deduction_ids[] = $record->id;
        }
        
        // Collect all deduction IDs from $data['deduction_id'], ensuring they are valid
        if ($request->has('deduction_id') && is_array($request->deduction_id)) {
            $deduction_ids = array_merge($deduction_ids, array_filter($request->deduction_id));
        }        
        // dd($deduction_ids);

        // Finally, sync everything at once, removing old records
        $user->deductions()->sync($deduction_ids);

        return redirect()->route('home')->with('success', 'User information updated successfully.');
    }
}
