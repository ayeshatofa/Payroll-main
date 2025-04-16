{{-- @extends('layouts.app')
@section('title')
    Bonus Page
@endsection

@section('content')
<div class="my-5"></div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('bonus.store')}}" method="post">
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
                            <label for="bonusType">Bonus Type: </label>
                            <select name="bonusType" id="bonusType" class="form-control" onchange="updateMonthField()">
                                <option value="">Select Bonus Type</option>
                                <option value="Monthly" {{ old('bonusType') == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="Half-yearly" {{ old('bonusType') == 'Half-yearly' ? 'selected' : '' }}>Half-yearly</option>
                                <option value="Annually" {{ old('bonusType') == 'Annually' ? 'selected' : '' }}>Annually</option>
                            </select>
                            
                            @error('bonusType')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>                        
                        <div class="mb-5" id="monthField">
                            <label for="month">Month: </label>
                            <select name="month[]" id="month" class="form-control" multiple>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                            @error('month')
                                <span class="text-danger">{{ $message }}</span>
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
    function updateMonthField() {
        var bonusType = document.getElementById('bonusType').value;
        var monthField = document.getElementById('month');

        // Reset month field
        monthField.innerHTML = '';

        if (bonusType === 'Monthly') {
            // Set single "Every" option for Monthly
            monthField.innerHTML = '<option value="Every" selected>Every</option>';
            monthField.removeAttribute('multiple');
        } else if (bonusType === 'Half-yearly') {
            // Allow multiple selections for Half-yearly
            monthField.setAttribute('multiple', 'multiple');
            let months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            months.forEach(month => {
                monthField.innerHTML += `<option value="${month}">${month}</option>`;
            });
        } else if (bonusType === 'Annually') {
            // Only allow one selection for Annually
            monthField.removeAttribute('multiple');
            let months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            months.forEach(month => {
                monthField.innerHTML += `<option value="${month}">${month}</option>`;
            });
        }
    }

    function limitHalfYearlySelection(event) {
        var bonusType = document.getElementById('bonusType').value;
        var selectedMonths = Array.from(event.target.selectedOptions).map(option => option.value);

        if (bonusType === 'Half-yearly' && selectedMonths.length > 2) {
            alert("You can only select **TWO** months for Half-yearly bonuses.");
            event.target.options[event.target.selectedIndex].selected = false; // Deselect the last selected option
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        updateMonthField();

        // Add event listener to restrict selections
        document.getElementById('month').addEventListener('change', limitHalfYearlySelection);
    });

    document.getElementById('bonusType').addEventListener('change', function() {
        updateMonthField();
        document.getElementById('month').addEventListener('change', limitHalfYearlySelection);
    });
</script>
@endsection --}}
@extends('layouts.app')
@section('title')
    Bonus Page
@endsection

@section('content')
<div class="my-5"></div>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="text-primary font-weight-bold mb-0">Add Bonus Information</h5>
                    <a href="{{ route('bonus.index') }}" class="btn btn-sm btn-secondary">
                        ← Back
                    </a>
                </div>

                <form action="{{route('bonus.store')}}" method="post">
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
                        <label for="bonusType">Bonus Type: </label>
                        <select name="bonusType" id="bonusType" class="form-control" onchange="updateMonthField()">
                            <option value="">Select Bonus Type</option>
                            <option value="Monthly" {{ old('bonusType') == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                            <option value="Half-yearly" {{ old('bonusType') == 'Half-yearly' ? 'selected' : '' }}>Half-yearly</option>
                            <option value="Annually" {{ old('bonusType') == 'Annually' ? 'selected' : '' }}>Annually</option>
                        </select>
                        @error('bonusType')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>                        

                    <div class="mb-5" id="monthField">
                        <label for="month">Month: </label>
                        <select name="month[]" id="month" class="form-control" multiple>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                        @error('month')
                            <span class="text-danger">{{ $message }}</span>
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
    function updateMonthField() {
        var bonusType = document.getElementById('bonusType').value;
        var monthField = document.getElementById('month');
        monthField.innerHTML = '';

        if (bonusType === 'Monthly') {
            monthField.innerHTML = '<option value="Every" selected>Every</option>';
            monthField.removeAttribute('multiple');
        } else if (bonusType === 'Half-yearly') {
            monthField.setAttribute('multiple', 'multiple');
            let months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            months.forEach(month => {
                monthField.innerHTML += `<option value="${month}">${month}</option>`;
            });
        } else if (bonusType === 'Annually') {
            monthField.removeAttribute('multiple');
            let months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            months.forEach(month => {
                monthField.innerHTML += `<option value="${month}">${month}</option>`;
            });
        }
    }

    function limitHalfYearlySelection(event) {
        var bonusType = document.getElementById('bonusType').value;
        var selectedMonths = Array.from(event.target.selectedOptions).map(option => option.value);

        if (bonusType === 'Half-yearly' && selectedMonths.length > 2) {
            alert("You can only select TWO months for Half-yearly bonuses.");
            event.target.options[event.target.selectedIndex].selected = false;
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        updateMonthField();
        document.getElementById('month').addEventListener('change', limitHalfYearlySelection);
    });

    document.getElementById('bonusType').addEventListener('change', function() {
        updateMonthField();
        document.getElementById('month').addEventListener('change', limitHalfYearlySelection);
    });
</script>
@endsection
