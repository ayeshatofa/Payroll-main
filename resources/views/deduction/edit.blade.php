@extends('layout.master')

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
@endsection
