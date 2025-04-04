@extends('layouts.app')

@section('title')
    Edit 
@endsection

@section('content')
    <div class="container">
        <h2>Edit Employee Leave</h2>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form method="POST" action="{{ route('attendance.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label for="start_date">Start Date: </label>
                <input id="start_date" type="date" class="form-control border-primary" name="start_date" value="{{ old('start_date') }}" required>
                @error('start_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>  
            <div class="mb-5">
                <label for="end_date">End Date: </label>
                <input id="end_date" type="date" class="form-control border-primary" name="end_date" value="{{ old('end_date') }}" required>
                @error('end_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div> 
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Confirm Leave</button>
            </div>
        </form>
    </div>
@endsection