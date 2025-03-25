@extends('layout.master') 
@section('title')
    Department Details
@endsection

@section('content')
<div class="my-5"></div>
<div class="row">
    <div class="col-md-8 offset-md-2"> {{-- Center the card --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Department Details</h4>
                <a href="{{ route('department.index') }}" class="btn btn-primary">Back to Department List</a>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h5 class="text-muted">Department Name</h5>
                    <p class="fw-bold">{{ $department->dep_name }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
