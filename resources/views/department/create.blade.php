@extends('layouts.app') 
@section('title')
    Department Page
@endsection

@section('content')
<div class="my-5"></div>
    <div class="row">
        <div class="col-md-6 offset-md-3"> {{-- Centering the form --}}
            <div class="card">
                <div class="card-header">
                    <h4>Add New Department</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('department.store') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="dep_name" class="form-label">Department Name:</label>
                            <input type="text" name="dep_name" id="dep_name" class="form-control" required>
                            @error('dep_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('department.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
