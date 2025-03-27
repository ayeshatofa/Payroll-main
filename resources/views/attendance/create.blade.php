@extends('layout.master') 

@section('title', 'Attendance Page')

@section('content')
<div class="my-5"></div>
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header">
                <h4>Attendance</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('attendance.store') }}" method="post">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label">Date:</label>
                        <input type="text" class="form-control" value="{{ now()->toDateString() }}" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Check-in Time:</label>
                        <input type="text" name="check_in_time" id="check_in_time" class="form-control"
                            value="{{ $attendance->check_in_time ?? 'Click check-in button' }}" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Check-out Time:</label>
                        <input type="text" name="check_out_time" id="check_out_time" class="form-control"
                            value="{{ $attendance->check_out_time ?? 'Click check-out button' }}" readonly>
                    </div>

                    <div class="text-center">
                        @if(!$attendance || !$attendance->check_in_time)
                            <button type="submit" class="btn btn-success">Check In</button>
                        @elseif(!$attendance->check_out_time)
                            <button type="submit" class="btn btn-danger">Check Out</button>
                        @else
                            <button class="btn btn-secondary" disabled>Already Checked In & Out</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
