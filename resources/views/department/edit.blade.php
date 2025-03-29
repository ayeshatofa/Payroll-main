@extends('layouts.app') 
@section('title')
    Edit Department
@endsection

@section('content')
<div class="my-5"></div>
<div class="row">
    <div class="col-md-6 offset-md-3"> {{-- Centering the form --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Edit Department</h4>
                <a href="{{ route('department.index') }}" class="btn btn-danger">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('department.update', $department->dep_id) }}" method="post">
                    @csrf
                    @method("PUT")
                    <div class="mb-4">
                        <label for="dep_name" class="form-label">Department Name:</label>
                        <input type="text" name="dep_name" id="dep_name" class="form-control" value="{{ $department->dep_name }}" required>
                        @error('dep_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('department.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
