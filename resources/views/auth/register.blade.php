@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="designation">Designation: </label>
                            <select name="position" id="designation" class="form-control">
                                <option value="">-- Select Designation --</option>
                                <option value="VC" {{ old('designation') == 'VC' ? 'selected' : '' }}>VC</option>
                                <option value="Pro VC" {{ old('designation') == 'Pro VC' ? 'selected' : '' }}>Pro VC</option>
                                <option value="Treasurer" {{ old('designation') == 'Treasurer' ? 'selected' : '' }}>Treasurer</option>
                                <option value="Registerer" {{ old('designation') == 'Registerer' ? 'selected' : '' }}>Registerer</option>
                                <option value="Dean" {{ old('designation') == 'Dean' ? 'selected' : '' }}>Dean</option>
                                <option value="Professor" {{ old('designation') == 'Professor' ? 'selected' : '' }}>Professor</option>
                                <option value="Associate Professor" {{ old('designation') == 'Associate Professor' ? 'selected' : '' }}>Associate Professor</option>
                                <option value="Assistant Professor" {{ old('designation') == 'Assistant Professor' ? 'selected' : '' }}>Assistant Professor</option>
                                <option value="Lecturer" {{ old('designation') == 'Lecturer' ? 'selected' : '' }}>Lecturer</option>
                                <option value="Senior Staff" {{ old('designation') == 'Senior Staff' ? 'selected' : '' }}>Senior Staff</option>
                                <option value="Junior Staff" {{ old('designation') == 'Junior Staff' ? 'selected' : '' }}>Junior Staff</option>
                            </select>
                        
                            @error('position')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-5">
                            <label for="dep_id">Department Name: </label>
                            <select name="dep_id" id="dep_id" class="form-control">
                                @foreach ($departments as $department)
                                    <option value="{{ $department->dep_id }}">{{ $department->dep_name }}</option>
                                @endforeach
                            </select>
                            @error('dep_id')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label for="date_of_join" class="col-md-4 col-form-label text-md-end">{{ __('Date of Join') }}</label>

                            <div class="col-md-6">
                                <input id="date_of_join" type="date" class="form-control @error('date_of_join') is-invalid @enderror" name="date_of_join" value="{{ old('date_of_join') }}" required>

                                @error('date_of_join')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
                            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="3" required>{{ old('address') }}</textarea>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="deduction_id">Deduction Name: </label>
                            <div>
                                @foreach ($deductions as $deduction)
                                    <div class="form-check">
                                        <input type="checkbox" name="deduction_id[]" id="ded_{{ $deduction->id }}" value="{{ $deduction->id }}" class="form-check-input">
                                        <label for="ded_{{ $deduction->id }}" class="form-check-label">{{ $deduction->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('deduction_id')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>                        
                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
