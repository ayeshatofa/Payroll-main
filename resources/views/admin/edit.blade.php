@extends('layouts.app')

@section('title')
    Edit 
@endsection

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
                <select name="position" id="position" class="form-control">
                    <option value="">-- Select Designation --</option>
                    @foreach ($positions as $position)
                        <option value="{{ $position->name }}" 
                            {{ old('position', $user->position) == $position->name ? 'selected' : '' }}>
                            {{ $position->name }}
                        </option>
                    @endforeach
                </select>
                @error('position')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>  
            
            <div class="mb-3">
                <label for="dep_id" class="form-label fw-semibold">Department Name</label>
                <select name="dep_id" id="dep_id" class="form-select border-primary">
                    @foreach ($departments as $department)
                        <option value="{{ $department->dep_id }}">{{ $department->dep_name }}</option>
                    @endforeach
                </select>
                @error('dep_id')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </div>
        </form>
    </div>
@endsection


@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let designationDropdown = document.getElementById("position");
        let departmentDropdown = document.getElementById("dep_id");
    
        designationDropdown.addEventListener("change", function () {
            let selectedValue = this.value;
    
            // Check if the selected designation should trigger "All Departments"
            if (["VC", "Pro VC", "Treasurer", "Registerer"].includes(selectedValue)) {
                departmentDropdown.innerHTML = '<option value=1>All Departments</option>';
            } else {
                // Reset to original department options if another designation is selected
                departmentDropdown.innerHTML = `@foreach ($departments as $department)
                    @if($department->dep_id != 1)
                        <option value="{{ $department->dep_id }}">{{ $department->dep_name }}</option>
                    @endif
                @endforeach`;
            }
        });
    });
    </script>    
@endsection
