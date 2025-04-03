@extends('layouts.app') 
@section('title')
    Edit Position
@endsection

@section('content')
<div class="my-5"></div>
<div class="row">
    <div class="col-md-6 offset-md-3"> {{-- Centering the form --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Edit Position</h4>
                <a href="{{ route('position.index') }}" class="btn btn-danger">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('position.update', $position->id) }}" method="post">
                    @csrf
                    @method("PUT")
                    <div class="mb-4">
                        <label for="name" class="form-label">Position Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $position->name }}" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('position.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
