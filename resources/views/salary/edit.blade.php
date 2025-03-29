@extends('layouts.app') 
@section('title')
    Edit Salary
@endsection

@section('content')
<div class="my-5"></div>
<div class="row">
    <div class="col-md-6 offset-md-3"> {{-- Centering the form --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Edit Salary</h4>
                <a href="{{ route('salary.index') }}" class="btn btn-danger">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('salary.update', $salary->salary_id) }}" method="post">
                    @csrf
                    @method("PUT")
                    <div class="mb-4">
                        <label for="basic_salary" class="form-label">Basic Salary:</label>
                        <input type="number" name="basic_salary" id="basic_salary" class="form-control" value="{{ $salary->basic_salary }}" required>
                        @error('basic_salary')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="allowance">Allowance:</label>
                        <input type="number" name="allowance" id="allowance" class="form-control" value="{{ $salary->allowance }}" required>
                        @error('allowance')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="tax_rate">Tax Rate:</label>
                        <input type="number" name="tax_rate" id="tax_rate" class="form-control" value="{{ $salary->tax_rate }}" required>
                        @error('tax_rate')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="grade">Grade:</label>
                        <input type="number" name="grade" id="grade" class="form-control" value="{{ $salary->grade }}" required>
                        @error('grade')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('salary.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
