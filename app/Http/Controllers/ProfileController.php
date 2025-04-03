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
use Illuminate\Support\Facades\Auth;

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

    public function attendance()
    {
        $user = auth()->user();
        $attendances = DB::table('attendances')->where('user_id', $user->id)->latest()->get();

        return view('profile.attendance', compact('attendances'));
    }
    public function deduction()
    {
        $user = auth()->user();
        $deductionIds = DB::table('user_deductions')->where('user_id', $user->id)->pluck('deduction_id');
        $deductions = DB::table('deductions')
            ->whereIn('id', $deductionIds)
            ->get();

        return view('profile.deduction', compact('deductions'));
    }
    public function bonus()
    {
        $user = auth()->user();
        $bonusIds = DB::table('users_bonuses')->where('user_id', $user->id)->pluck('bonus_id');
        $bonuses = DB::table('bonuses')
             ->whereIn('id', $bonusIds)
             ->get();

        return view('profile.bonus', compact('bonuses'));
    }
    public function show()
    {
        $user = auth()->user();

 

        return view('profile.show', compact('user'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Ensure valid image format
        ]);
    
        $user = auth()->user();
        $input = $request->except('image');
   
        // Handle Image Upload
        if ($image = $request->file('image')) {
            $destinationPath = 'storage/profile_images/'; // Store in storage/app/public/profile_images
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path($destinationPath), $profileImage);
    
            if ($user->image && file_exists(public_path('storage/profile_images/' . $user->image))) {
                unlink(public_path('storage/profile_images/' . $user->image));
            }
    
            $input['image'] = $profileImage;
        } else {
            $input['image'] = $user->image; 
        }
    
        // Update User Data
        $user->update($input);
        
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

        return redirect()->route('profile.show')->with('success', 'User information updated successfully.');
    }

    public function invoice($id)
    {
        if (Auth::id() !== (int)$id) {
            abort(403, 'Unauthorized access.');
        }

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
            return redirect()->route('profile.index')->with('error', 'No payroll found for this user this month.');
        }

        return view('profile.invoice', compact(['user', 'record']));


        $pdf = PDF::loadView('profile.invoice-pdf', compact(['user', 'record']));
        return $pdf->download('salary_invoice_' . $user->id . '.pdf');
    }

    public function downloadInvoice($id)
    {
        $user = User::findOrFail($id);

        $currentMonth = Carbon::now()->format('F');

        $record = DB::table('payrolls')
                        ->join('taxes', 'payrolls.user_id', '=', 'taxes.user_id')
                        ->select('payrolls.*', 'taxes.tax_amount', 'taxes.tax_rate', 'taxes.payable_salary') // Adjust fields as needed
                        ->where('payrolls.user_id', $id)
                        ->where('payrolls.month', $currentMonth)
                        ->first();

        if (!$record) {
            return redirect()->route('profile.index')->with('error', 'No payroll found for this user this month.');
        }

        $pdf = PDF::loadView('profile.invoice-pdf', compact(['user', 'record']));
        return $pdf->download('salary_invoice_' . $user->id . '.pdf');
    }

}
