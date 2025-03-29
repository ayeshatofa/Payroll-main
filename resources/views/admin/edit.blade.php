@extends('layout.master')

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
        <form method="POST" action="{{ route('admin.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label for="designation">Designation: </label>
                <select name="position" id="designation" class="form-control">
                    <option value="">-- Select Designation --</option>
                    <option value="VC" {{ old('position', $user->position) == 'VC' ? 'selected' : '' }}>VC</option>
                    <option value="Pro VC" {{ old('position', $user->position) == 'Pro VC' ? 'selected' : '' }}>Pro VC</option>
                    <option value="Treasurer" {{ old('position', $user->position) == 'Treasurer' ? 'selected' : '' }}>Treasurer</option>
                    <option value="Registerer" {{ old('position', $user->position) == 'Registerer' ? 'selected' : '' }}>Registerer</option>
                    <option value="Dean" {{ old('position', $user->position) == 'Dean' ? 'selected' : '' }}>Dean</option>
                    <option value="Professor" {{ old('position', $user->position) == 'Professor' ? 'selected' : '' }}>Professor</option>
                    <option value="Associate Professor" {{ old('position', $user->position) == 'Associate Professor' ? 'selected' : '' }}>Associate Professor</option>
                    <option value="Assistant Professor" {{ old('position', $user->position) == 'Assistant Professor' ? 'selected' : '' }}>Assistant Professor</option>
                    <option value="Lecturer" {{ old('position', $user->position) == 'Lecturer' ? 'selected' : '' }}>Lecturer</option>
                    <option value="Senior Staff" {{ old('position', $user->position) == 'Senior Staff' ? 'selected' : '' }}>Senior Staff</option>
                    <option value="Junior Staff" {{ old('position', $user->position) == 'Junior Staff' ? 'selected' : '' }}>Junior Staff</option>
                </select>
            
                @error('position')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>            
            
            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </div>
        </form>
    </div>
@endsection
