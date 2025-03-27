@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Profile</h2>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form to Edit Profile -->
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Address Field -->
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $user->address) }}">
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Position Field (Dropdown) -->
            <div class="mb-5">
                <label for="deduction_id">Deduction Name: </label>
                <div>
                    @foreach ($deductions as $deduction)
                        <div class="form-check">
                            <input type="checkbox" name="deduction_id[]" id="ded_{{ $deduction->id }}" value="{{ $deduction->id }}" 
                                class="form-check-input"
                                {{ in_array($deduction->id, old('deduction_id', $user->deductions->pluck('id')->toArray())) ? 'checked' : '' }}>
                                
                            <label for="ded_{{ $deduction->id }}" class="form-check-label">{{ $deduction->name }}</label>
                        </div>
                    @endforeach
                </div>
                @error('deduction_id')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            
            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </div>
        </form>
    </div>
@endsection
