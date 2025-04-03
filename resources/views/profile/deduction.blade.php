@extends('layouts.app')

@section('title')
    Profile Deduction
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="mb-4">
                <h4 class="text-muted">Deduction List</h4>
                @if($deductions->count() > 0)
                    <div class="table-responsive">
                        <table class="table custom-table mt-3">
                            <thead class="bg-gradient text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($deductions as $deduction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        
                                        <td>{{ $deduction->name }}</td>
                                    
                                        <td>{{number_format($deduction->rate, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-warning">No deductions found.</p>
                @endif
            </div>
                
        </div>
    </div>
@endsection