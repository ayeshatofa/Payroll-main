@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100 bg-primary">
    <div class="col-md-8 col-lg-6 bg-white p-5 rounded shadow-lg">
        <h2 class="text-center text-primary fw-bold mb-4">{{ __('Register') }}</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Name</label>
                <input id="name" type="text" class="form-control border-primary" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email Address</label>
                <input id="email" type="email" class="form-control border-primary" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input id="password" type="password" class="form-control border-primary" name="password" required>
                @error('password')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password-confirm" class="form-label fw-semibold">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control border-primary" name="password_confirmation" required>
            </div>

            <!-- Designation -->
            {{-- <div class="mb-3">
                <label for="designation" class="form-label fw-semibold">Designation</label> --}}
                {{-- <select name="position" id="designation" class="form-select border-primary">
                    <option value="">-- Select Designation --</option>
                    <option value="VC">VC</option>
                    <option value="Pro VC">Pro VC</option>
                    <option value="Treasurer">Treasurer</option>
                    <option value="Registerer">Registerer</option>
                    <option value="Dean">Dean</option>
                    <option value="Professor">Professor</option>
                    <option value="Associate Professor">Associate Professor</option>
                    <option value="Assistant Professor">Assistant Professor</option> --}}
                    {{-- <option value="Lecturer">Lecturer</option>
                    <option value="Senior Staff">Senior Staff</option>
                    <option value="Junior Staff">Junior Staff</option>
                </select>
                @error('position')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div> --}}
            <div class="mb-3">
                <label for="designation" class="form-label fw-semibold">Designation</label>
                <select name="position" id="position" class="form-select border-primary">
                    <option value="">-- Select Designation --</option>
                    @foreach ($positions as $position)
                        <option value="{{ $position->name }}">{{ $position->name }}</option>
                    @endforeach
                </select>
                @error('dep_id')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            <!-- Department -->
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

            <!-- Date of Join -->
            <div class="mb-3">
                <label for="date_of_join" class="form-label fw-semibold">Date of Join</label>
                <input id="date_of_join" type="date" class="form-control border-primary" name="date_of_join" value="{{ old('date_of_join') }}" max="{{ date('Y-m-d') }}" required>
                @error('date_of_join')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            

            <!-- Address -->
            <div class="mb-3">
                <label for="address" class="form-label fw-semibold">Address</label>
                <textarea name="address" id="address" class="form-control border-primary" rows="3" required>{{ old('address') }}</textarea>
                @error('address')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Deduction Name -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Deduction Name</label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($deductions as $deduction)
                        <div class="form-check">
                            <input type="checkbox" name="deduction_id[]" id="ded_{{ $deduction->id }}" value="{{ $deduction->id }}" class="form-check-input border-primary">
                            <label for="ded_{{ $deduction->id }}" class="form-check-label">{{ $deduction->name }}</label>
                        </div>
                    @endforeach
                </div>
                @error('deduction_id')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
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