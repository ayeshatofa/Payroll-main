{{-- @extends('layouts.app')

@section('title')
    Edit Deduction
@endsection

@section('content')
<div class="my-5"></div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('deduction.update', $deduction->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="mb-5">
                            <label for="name">Name: </label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $deduction->name) }}">
                            @error('name')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="rate">Rate: </label>
                            <input type="number" name="rate" id="rate" class="form-control" value="{{ old('rate', $deduction->rate) }}">
                            @error('rate')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>

                        <div class="mb-5">
                          <label for="gradeNumbers">Grade Numbers: </label>
                          <select name="gradeNumbers[]" id="gradeNumbers" class="form-control" multiple>
                             <option value="" {{ (in_array(null, old('gradeNumbers', json_decode($deduction->gradeNumbers, true) ?? []))) ? 'selected' : '' }}>Optional</option>
                              @foreach($grades as $grade)
                                  <option value="{{ $grade }}" 
                                      {{ in_array($grade, old('gradeNumbers', json_decode($deduction->gradeNumbers, true) ?? [])) ? 'selected' : '' }} >
                                      {{ $grade }}
                                  </option>
                              @endforeach
                          </select>
                          
                          @error('gradeNumbers')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                                              
                        <div class="mb-5">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // Get the select element
        const gradeSelect = document.getElementById('gradeNumbers');
        
        // Listen for change on the select element
        gradeSelect.addEventListener('change', function() {
            const selectedOptions = Array.from(gradeSelect.selectedOptions).map(option => option.value);
            
            // If 'Optional' is selected, deselect all other options
            if (selectedOptions.includes('')) {
                // Deselect all other options except 'Optional'
                for (let option of gradeSelect.options) {
                    if (option.value !== '') {
                        option.selected = false;
                    }
                }
            } else {
                // If any other option is selected, deselect 'Optional'
                const optionalOption = gradeSelect.querySelector('option[value=""]');
                optionalOption.selected = false;
            }
        });
    </script>
@endsection --}}
@extends('layouts.app')

@section('title')
    Edit Deduction
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Deduction</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('deduction.update', $deduction->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <!-- Deduction Name -->
                        <div class="mb-4">
                            <label for="name" class="fw-bold">Name:</label>
                            <input type="text" name="name" id="name" class="form-control" 
                                   value="{{ old('name', $deduction->name) }}" required>
                            @error('name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Deduction Rate -->
                        <div class="mb-4">
                            <label for="rate" class="fw-bold">Rate:</label>
                            <input type="number" name="rate" id="rate" class="form-control" 
                                   value="{{ old('rate', $deduction->rate) }}" required>
                            @error('rate')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Grade Numbers -->
                        <div class="mb-4">
                            <label for="gradeNumbers" class="fw-bold">Grade Numbers:</label>
                            <select name="gradeNumbers[]" id="gradeNumbers" class="form-control" multiple>
                                <option value="" {{ in_array(null, old('gradeNumbers', json_decode($deduction->gradeNumbers, true) ?? [])) ? 'selected' : '' }}>
                                    Optional
                                </option>
                                @foreach($grades as $grade)
                                    <option value="{{ $grade }}" 
                                        {{ in_array($grade, old('gradeNumbers', json_decode($deduction->gradeNumbers, true) ?? [])) ? 'selected' : '' }}>
                                        {{ $grade }}
                                    </option>
                                @endforeach
                            </select>
                            @error('gradeNumbers')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-primary px-4">Update</button>
                            <a href="{{ route('deduction.index') }}" class="btn btn-success px-4">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const gradeSelect = document.getElementById('gradeNumbers');

        gradeSelect.addEventListener('change', function () {
            const selectedOptions = Array.from(gradeSelect.selectedOptions).map(option => option.value);

            if (selectedOptions.includes('')) {
                for (let option of gradeSelect.options) {
                    if (option.value !== '') {
                        option.selected = false;
                    }
                }
            } else {
                const optionalOption = gradeSelect.querySelector('option[value=""]');
                optionalOption.selected = false;
            }
        });
    });
</script>
@endsection
