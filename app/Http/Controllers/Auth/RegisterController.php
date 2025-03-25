<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use App\Models\Bonus;
use App\Models\Deduction;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $departments = Department::all(); // Get all departments
        $deductions = Deduction::where(function ($query) {
            $query->whereNull('gradeNumbers')
                  ->orWhere('gradeNumbers', '[null]'); // Check if JSON is empty array
        })->get();        
        // dd($deductions);
        return view('auth.register', compact('departments', 'deductions'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'date_of_join' => ['required', 'date'],
            'address' => ['required', 'string'],
            'position' => ['required', 'string'],
            'dep_id' => ['required', 'exists:departments,dep_id'],
            'deduction_id' => 'array', 
            'deduction_id.*' => 'integer|exists:deductions,id', 
        ]);
    }

    protected function create(array $data)
    {
        // Determine the grade based on the position
        $grade = match ($data['position']) {
            'Professor' => 1,
            'Associate Professor' => 2,
            'Assistant Professor' => 3,
            'Lecturer' => 4,
            default => null, // Handle unexpected values
        };

        // Create the new user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'date_of_join' => $data['date_of_join'],
            'address' => $data['address'],
            'dep_id' => $data['dep_id'],
            'position' => $data['position'],
            'grade' => $grade,
        ]);
        
        // filling up users_bonueses pivot table
        $records = $grade !== null
            ? Bonus::whereJsonContains('gradeNumbers', (string) $grade)->get()
            : collect(); 

        $bonusData = [];
        foreach ($records as $record) {
            $bonusData[$record->id] = ['month' => $record->month]; 
        }
        
        $user->bonuses()->attach($bonusData); 
        
        // filling up user_deduction pivot table
        $records = $grade !== null
        ? Deduction::whereJsonContains('gradeNumbers', (string) $grade)->get()
        : collect(); 

        // Attach all deduction records to the user
        foreach ($records as $record) {
            $user->deductions()->attach($record->id);
        }
        
        if (!empty($data['deduction_id']) && is_array($data['deduction_id'])) {
            $deduction_ids = array_filter($data['deduction_id']); // Remove empty values

            // Attach deductions without removing existing ones
            $user->deductions()->syncWithoutDetaching($deduction_ids);
        }
        return $user;
    }

}
