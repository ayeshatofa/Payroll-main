<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bonus;
use App\Models\User;
use App\Models\Deduction;
use App\Models\Payroll;
use App\Models\Tax;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('user'); 
    }

    public function index()
    {
        $user = auth()->user();

        $currentMonth = Carbon::now()->format('F');

        $record = DB::table('payrolls')
                    ->join('taxes', 'payrolls.user_id', '=', 'taxes.user_id')
                    ->select('payrolls.*', 'taxes.tax_amount', 'taxes.tax_rate', 'taxes.payable_salary') // Adjust fields as needed
                    ->where('payrolls.user_id', $user->id)
                    ->where('payrolls.month', $currentMonth)
                    ->first();

        $transactions = Transaction::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('profile.index', compact('user', 'record', 'transactions'));
    }
    public function edit()
    {
        $user = auth()->user(); 
        $deductions = Deduction::where(function ($query) {
            $query->whereNull('gradeNumbers')
                  ->orWhere('gradeNumbers', '[null]'); // Check if JSON is empty array
        })->get(); 
        return view('profile.edit', compact(['user', 'deductions']));
    }

    public function update(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => ['required', 'string'],
        ]);
        $user = auth()->user(); 
        
        $user->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);
        
        $records = $user->grade !== null
        ? Deduction::whereJsonContains('gradeNumbers', (string) $user->grade)->get()
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
        $user->deductions()->sync($deduction_ids);

        return redirect()->route('home')->with('success', 'User information updated successfully.');
    }

    public function invoice($id)
    {
        // Fetch the user details
        $user = User::findOrFail($id);

        $currentMonth = Carbon::now()->format('F');

        $record = DB::table('payrolls')
                        ->join('taxes', 'payrolls.user_id', '=', 'taxes.user_id')
                        ->select('payrolls.*', 'taxes.tax_amount', 'taxes.tax_rate', 'taxes.payable_salary') // Adjust fields as needed
                        ->where('payrolls.user_id', $id)
                        ->where('payrolls.month', $currentMonth)
                        ->first();

        if (!$record) {
            return redirect()->route('home')->with('error', 'No payroll found for this user this month.');
        }


        $pdf = PDF::loadView('profile.invoice', compact(['user', 'record']));
        return $pdf->download('invoice.pdf');
    }


}
