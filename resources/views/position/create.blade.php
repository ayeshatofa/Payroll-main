@extends('layouts.app') 
@section('title')
    Position Page
@endsection

@section('content')
<div class="my-5"></div>
    <div class="row">
        <div class="col-md-6 offset-md-3"> {{-- Centering the form --}}
            <div class="card">
                <div class="card-header">
                    <h4>Add New Position</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('position.store') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="form-label">Position Name:</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('position.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
