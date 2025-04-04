{{-- @extends('layouts.app')

@section('title')
    {{ $user->name }}'s Dashboard
@endsection

@section('content')
     <h1>This is the user dashboard</h1>
@endsection --}}
@extends('layouts.app')

@section('title')

    {{ $user->name }}'s Dashboard
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
            <div class="card shadow-lg border-0 rounded">
               

                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h4 class="mt-3">{{ $user->name }}</h4>
                        <p class="text-muted">{{ $user->position }}</p>
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>📧 Email</span>
                            <span>{{ $user->email }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span🏠 Address</span>
                            <span>{{ $user->address }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>📅 Joined</span>
                            <span>{{ $user->created_at->format('d M Y') }}</span>
                        </li>
                    </ul>
                </div>

                  <!-- Salary Details -->
                  <div class="mb-4">
                    <h4 class="text-muted">Salary Details ({{ date('F Y') }})</h4>
                    @if($record)
                        <ul class="list-group salary-box">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Salary</span>
                                <span class="text-success fw-bold">${{ number_format($record->payroll, 2) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Tax Deduction</span>
                                <span class="text-danger fw-bold">-${{ number_format($record->tax_amount, 2) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <strong>Final Pay</strong>
                                <strong class="text-primary">${{ number_format($record->payable_salary, 2) }}</strong>
                            </li>
                        </ul>
                    @else
                        <p class="text-danger mt-2">No payroll details available for this month.</p>
                    @endif
                </div>

                <!-- Payment History -->
                <div class="mb-4">
                    <h4 class="text-muted">Payment History</h4>
                    @if($transactions->count() > 0)
                        <div class="table-responsive">
                            <table class="table custom-table mt-3">
                                <thead class="bg-gradient text-white">
                                    <tr>
                                        <th>Amount</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <td class="fw-bold text-success">${{ number_format($transaction->amount / 100, 2) }}</td>
                                            <td>{{ $transaction->description }}</td>
                                            <td>{{ $transaction->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-warning">No transactions found.</p>
                    @endif
                </div>

                
                <div class="row">
                    <div class="col-md-3">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                              <h5 class="card-title">Attendances History</h5>
                              <p class="card-text">Here you can check your attedances history</p>
                              <a href="{{ route('profile.attendance') }}" class="btn btn-primary">Go</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                              <h5 class="card-title">Deduction List</h5>
                              <p class="card-text">Here you can check your deductions list</p>
                              <a href="{{ route('profile.deduction') }}" class="btn btn-primary">Click</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                              <h5 class="card-title">Bonus List</h5>
                              <p class="card-text">Here you can check your bonuses list</p>
                              <a href="{{ route('profile.bonus') }}" class="btn btn-primary">Click</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                              <h5 class="card-title">Feedback List</h5>
                              <p class="card-text">Here you can give see your feedback list</p>
                              <a href="{{ route('feedback.index') }}" class="btn btn-primary">Click</a>
                            </div>
                        </div>
                    </div>
                </div>
               
               


            </div>

            </div>
    </div>
</div>


@endsection
