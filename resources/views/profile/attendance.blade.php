@extends('layouts.app')

@section('title')
    Profile Attendance
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="mb-4">
                <h4 class="text-muted">Attendance History</h4>
                @if($attendances->count() > 0)
                    <div class="table-responsive">
                        <table class="table custom-table mt-3">
                            <thead class="bg-gradient text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Month</th>
                                    <th>Status</th>
                                    <th>Check in time </th>
                                    <th>Check out time </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendances as $attendance)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $attendance->date}}</td>
                                        <td>{{ $attendance->month }}</td>
                                        <td>{{ $attendance->status}}</td>
                                        <td>{{ $attendance->check_in_time }}</td>
                                        <td>{{ $attendance->check_out_time }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-warning">No attendances found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection