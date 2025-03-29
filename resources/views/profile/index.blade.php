@extends('layouts.app')

{{-- @section('title')
    {{ $user->name }}'s Profile
@endsection --}}

@section('content')
<div class="container mt-5">
    <h1 class="text-center">User Profile</h1>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>{{ $user->name }}</h4>
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Position:</strong> {{ $user->position }}</p>

                    <h5 class="mt-4">Current Salary Details ({{ date('F Y') }})</h5>
                    @if($record)
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Salary</span>
                                <span>${{ number_format($record->payroll, 2) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Tax Deduction</span>
                                <span>-${{ number_format($record->tax_amount, 2) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <strong>Final Pay</strong>
                                <strong>${{ number_format($record->payable_salary, 2) }}</strong>
                            </li>
                        </ul>
                    @else
                        <p class="text-danger mt-2">No payroll details available for this month.</p>
                    @endif

                    <h5 class="mt-4">Payment History</h5>
                    @if($transactions->count() > 0)
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>${{ number_format($transaction->amount / 100, 2) }}</td> <!-- Assuming amount is stored in cents -->
                                        <td>{{ $transaction->description }}</td>
                                        <td>{{ $transaction->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-warning mt-2">No transactions found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
