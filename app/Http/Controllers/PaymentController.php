<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payroll;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Tax;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Mail\PayEmail;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin'); // Only Admins can access
    }
    
    public function index()
    {
        $users = User::all();
        $currentMonth = Carbon::now()->format('F');
        foreach ($users as $user) {
            $user->has_paid = Transaction::where('user_id', $user->id)
                                         ->where('month', $currentMonth)
                                         ->exists(); // Check if there's any transaction for this user in the current month
        } 
        return view('stripe.index', compact('users'));
    }

    public function create($id)
    {
        $currentMonth = Carbon::now()->format('F');

        // $existingTransaction = Transaction::where('user_id', $id)
        //                             ->where('month', $currentMonth)
        //                             ->first();

        $record = DB::table('payrolls')
                        ->join('taxes', 'payrolls.user_id', '=', 'taxes.user_id')
                        ->select('payrolls.*', 'taxes.tax_amount', 'taxes.tax_rate', 'taxes.payable_salary') // Adjust fields as needed
                        ->where('payrolls.user_id', $id)
                        ->where('payrolls.month', $currentMonth)
                        ->get();

        session(['record' => $record]);
        
        return view('stripe.create', compact('record'));
    }

    public function charge(Request $request)
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $currentMonth = Carbon::now()->format('F');
        
        $amount = (int) $request['amount'];

        $charge = $stripe->charges->create([
            'amount' => $amount, // Convert to cents
            'source' => $request->stripeToken,
            'currency' => 'usd',
            'description' => 'Salary for ' . $currentMonth,
        ]);

        // Save transaction details to the database
        Transaction::create([
            // 'transaction_id' => $charge->id,
            'amount' => $charge->amount,
            'description' => $charge->description,
            'user_id' => $request['user_id'],
            'month' => $currentMonth
        ]);

        $userId = $request['user_id'];
        $record = collect(session('record'));
        $record = $record->first();
        $user = User::find($userId);
        // $to = $user->email;
        $to = "ayeshasultanatofa398@gmail.com";
        Mail::to($to)->send(new PayEmail($user, $record, $charge));
         
        return redirect()->route('stripe.index')->with('success', "Payment has been successfully processed for $user->name");
    }
}
