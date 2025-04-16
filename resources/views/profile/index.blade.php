@extends('layouts.app')

@section('title', $user->name . "'s Dashboard")

@section('content')
<div class="container py-4">
    <div class="row g-4">
        <!-- User Profile Card -->
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-4">
                        <div class="avatar-lg bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <h2 class="mb-1">{{ $user->name }}</h2>
                            <p class="text-muted mb-0">{{ $user->position }}</p>
                            <small class="text-muted">Member since {{ $user->date_of_join }}</small>
                        </div>
                    </div>
                    
                    <div class="row mt-4 g-3">
                        <div class="col-md-4">
                            <div class="info-item">
                                <i class="fas fa-envelope me-2"></i>
                                <span>{{ $user->email }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <span>Address: {{ $user->address ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Salary Summary -->
        <div class="col-lg-8">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Salary Details - {{ date('F Y') }}</h5>
                </div>
                <div class="card-body">
                    @if($record)
                    <div class="salary-breakdown">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Base Salary</span>
                            <span class="text-success">${{ number_format($record->payroll, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 text-danger">
                            <span>Tax</span>
                            <span>-${{ number_format($record->tax_amount, 2) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>Net Pay</span>
                            <span class="text-primary">${{ number_format($record->payable_salary, 2) }}</span>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-warning mb-0">No payroll records available this month</div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Quick Access</h5>
                </div>
                <div class="card-body d-grid gap-3">
                    <a href="{{ route('profile.attendance') }}" class="quick-link">
                        <i class="fas fa-calendar-check me-2"></i>
                        Attendance History
                    </a>
                    <a href="{{ route('profile.deduction') }}" class="quick-link">
                        <i class="fas fa-hand-holding-usd me-2"></i>
                        Deductions
                    </a>
                    <a href="{{ route('profile.bonus') }}" class="quick-link">
                        <i class="fas fa-gift me-2"></i>
                        Bonuses
                    </a>
                    <a href="{{ route('feedback.index') }}" class="quick-link">
                        <i class="fas fa-comments me-2"></i>
                        Feedback
                    </a>
                </div>
            </div>
        </div>

        <!-- Transaction History -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Payment History</h5>
                </div>
                <div class="card-body">
                    @if($transactions->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->created_at->format('d M Y') }}</td>
                                    <td>{{ $transaction->description }}</td>
                                    <td class="text-success fw-bold">${{ number_format($transaction->amount / 100, 2) }}</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-info mb-0">No transactions found in your account</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .avatar-lg {
        width: 80px;
        height: 80px;
        font-size: 2rem;
    }

    .info-item {
        padding: 12px;
        background: #f8f9fa;
        border-radius: 8px;
        display: flex;
        align-items: center;
    }

    .quick-link {
        padding: 12px;
        border-radius: 8px;
        color: #333;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .quick-link:hover {
        background: #f1f1f1;
        transform: translateX(5px);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0,123,255,0.05);
    }
</style>
@endsection