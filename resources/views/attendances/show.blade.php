@extends('layouts.app') 
@section('title')
   Attendance Details
@endsection

@section('content')
<div class="my-5"></div>
<div class="row">
    <div class="col-md-8 offset-md-2"> {{-- Center the card --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Department Details</h4>
                <a href="{{ route('attendance.index') }}" class="btn btn-primary">Back to Department List</a>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h5 class="text-muted">Attendece Date</h5>
                    <p class="fw-bold">{{ $attendance->dep_name }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
