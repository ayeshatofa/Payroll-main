@extends('layout.master')
@section('title')
    Category Page
@endsection

@section('content')
<div class="my-5"></div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('deduction.store')}}" method="post">
                        @csrf
                        <div class="mb-5">
                            <label for="name">Name: </label>
                            <input type="text" name="name" id="name" class="form-control">
                            @error('name')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="rate">Rate: </label>
                            <input type="number" name="rate" id="rate" class="form-control">
                            @error('rate')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-5">
                          <label for="gradeNumbers">Grade Numbers: </label>
                          <select name="gradeNumbers[]" id="gradeNumbers" class="form-control" multiple>
                             <option value="">Optional</option>
                              @foreach($grades as $grade)
                                  <option value="{{ $grade }}" 
                                      {{ in_array($grade, old('gradeNumbers', [])) ? 'selected' : '' }}>
                                      {{ $grade }}
                                  </option>
                              @endforeach
                          </select>
                          @error('gradeNumbers')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                                              
                        <div class="mb-5">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // Get the select element and optional option
        const gradeNumbersSelect = document.getElementById('gradeNumbers');
        const optionalOption = gradeNumbersSelect.querySelector('option[value=""]');

        // Add event listener for the select change
        gradeNumbersSelect.addEventListener('change', function() {
            const selectedOptions = Array.from(gradeNumbersSelect.selectedOptions).map(option => option.value);

            // If "Optional" is selected, unselect all other options
            if (selectedOptions.includes('')) {
                // Deselect all other options
                Array.from(gradeNumbersSelect.options).forEach(option => {
                    if (option.value !== '') {
                        option.selected = false;
                    }
                });
            } else {
                // If "Optional" is not selected, ensure the Optional is not selected
                optionalOption.selected = false;
            }
        });
    </script>
@endsection
