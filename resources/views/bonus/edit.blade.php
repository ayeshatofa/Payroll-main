@extends('layouts.app')

@section('title')
    Edit Bonus
@endsection

@section('content')
<div class="my-5"></div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('bonus.update', $bonus->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="mb-5">
                            <label for="name">Name: </label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $bonus->name) }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="bonusType">Bonus Type: </label>
                            <select name="bonusType" id="bonusType" class="form-control">
                                <option value="">Select Bonus Type</option>
                                <option value="Monthly" {{ old('bonusType', $bonus->bonusType) == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="Half-yearly" {{ old('bonusType', $bonus->bonusType) == 'Half-yearly' ? 'selected' : '' }}>Half-yearly</option>
                                <option value="Annually" {{ old('bonusType', $bonus->bonusType) == 'Annually' ? 'selected' : '' }}>Annually</option>
                            </select>
                            @error('bonusType')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-5" id="monthField">
                            <label for="month">Month: </label>
                            <select name="month[]" id="month" class="form-control" multiple>
                                <option value="Every" {{ in_array('Every', old('month', json_decode($bonus->month, true) ?? [])) ? 'selected' : '' }}>Every</option>
                                <option value="January" {{ in_array('January', old('month', json_decode($bonus->month, true) ?? [])) ? 'selected' : '' }}>January</option>
                                <option value="February" {{ in_array('February', old('month', json_decode($bonus->month, true) ?? [])) ? 'selected' : '' }}>February</option>
                                <option value="March" {{ in_array('March', old('month', json_decode($bonus->month, true) ?? [])) ? 'selected' : '' }}>March</option>
                                <option value="April" {{ in_array('April', old('month', json_decode($bonus->month, true) ?? [])) ? 'selected' : '' }}>April</option>
                                <option value="May" {{ in_array('May', old('month', json_decode($bonus->month, true) ?? [])) ? 'selected' : '' }}>May</option>
                                <option value="June" {{ in_array('June', old('month', json_decode($bonus->month, true) ?? [])) ? 'selected' : '' }}>June</option>
                                <option value="July" {{ in_array('July', old('month', json_decode($bonus->month, true) ?? [])) ? 'selected' : '' }}>July</option>
                                <option value="August" {{ in_array('August', old('month', json_decode($bonus->month, true) ?? [])) ? 'selected' : '' }}>August</option>
                                <option value="September" {{ in_array('September', old('month', json_decode($bonus->month, true) ?? [])) ? 'selected' : '' }}>September</option>
                                <option value="October" {{ in_array('October', old('month', json_decode($bonus->month, true) ?? [])) ? 'selected' : '' }}>October</option>
                                <option value="November" {{ in_array('November', old('month', json_decode($bonus->month, true) ?? [])) ? 'selected' : '' }}>November</option>
                                <option value="December" {{ in_array('December', old('month', json_decode($bonus->month, true) ?? [])) ? 'selected' : '' }}>December</option>
                            </select>                            
                            @error('month')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="rate">Rate: </label>
                            <input type="number" name="rate" id="rate" class="form-control" value="{{ old('rate', $bonus->rate) }}">
                            @error('rate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="gradeNumbers">Grade Numbers: </label>
                            <select name="gradeNumbers[]" id="gradeNumbers" class="form-control" multiple>
                                @foreach($grades as $grade)
                                    <option value="{{ $grade }}" 
                                        {{ in_array($grade, old('gradeNumbers', json_decode($bonus->gradeNumbers, true) ?? [])) ? 'selected' : '' }}>
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
                            <a href="{{ route('bonus.index') }}" class="btn btn-secondary">Cancel</a>
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
@endsection

{{-- @extends('layouts.app')

@section('title')
    Edit Bonus
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Bonus</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('bonus.update', $bonus->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <!-- Name Field -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Bonus Name</label>
                            <input type="text" name="name" id="name" class="form-control" 
                                value="{{ old('name', $bonus->name) }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Bonus Type Field -->
                        <div class="mb-3">
                            <label for="bonusType" class="form-label fw-bold">Bonus Type</label>
                            <select name="bonusType" id="bonusType" class="form-select">
                                <option value="">Select Bonus Type</option>
                                <option value="Monthly" {{ old('bonusType', $bonus->bonusType) == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="Half-yearly" {{ old('bonusType', $bonus->bonusType) == 'Half-yearly' ? 'selected' : '' }}>Half-yearly</option>
                                <option value="Annually" {{ old('bonusType', $bonus->bonusType) == 'Annually' ? 'selected' : '' }}>Annually</option>
                            </select>
                            @error('bonusType')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Month Selection -->
                        <div class="mb-3" id="monthField">
                            <label for="month" class="form-label fw-bold">Applicable Months</label>
                            <select name="month[]" id="month" class="form-select" multiple>
                                <option value="Every" {{ in_array('Every', old('month', json_decode($bonus->month, true) ?? [])) ? 'selected' : '' }}>Every</option>
                                @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                    <option value="{{ $month }}" {{ in_array($month, old('month', json_decode($bonus->month, true) ?? [])) ? 'selected' : '' }}>
                                        {{ $month }}
                                    </option>
                                @endforeach
                            </select>
                            @error('month')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Rate Field -->
                        <div class="mb-3">
                            <label for="rate" class="form-label fw-bold">Bonus Rate (%)</label>
                            <input type="number" name="rate" id="rate" class="form-control" 
                                value="{{ old('rate', $bonus->rate) }}" required>
                            @error('rate')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Grade Numbers -->
                        <div class="mb-3">
                            <label for="gradeNumbers" class="form-label fw-bold">Applicable Grades</label>
                            <select name="gradeNumbers[]" id="gradeNumbers" class="form-select" multiple>
                                @foreach($grades as $grade)
                                    <option value="{{ $grade }}" 
                                        {{ in_array($grade, old('gradeNumbers', json_decode($bonus->gradeNumbers, true) ?? [])) ? 'selected' : '' }}>
                                        Grade {{ $grade }}
                                    </option>
                                @endforeach
                            </select>
                            @error('gradeNumbers')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-success px-4">Update</button>
                            <a href="{{ route('bonus.index') }}" class="btn btn-danger px-4">Back</a>
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
    function updateMonthField() {
        var bonusType = document.getElementById('bonusType').value;
        var monthField = document.getElementById('month');
        var selectedMonths = @json(old('month', json_decode($bonus->month, true) ?? []));
        
        monthField.innerHTML = ''; // Clear previous options
        
        if (bonusType === 'Monthly') {
            monthField.innerHTML = '<option value="Every" selected>Every</option>';
        } else if (bonusType === 'Half-yearly' || bonusType === 'Annually') {
            let months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            months.forEach(month => {
                monthField.innerHTML += `<option value="${month}" ${selectedMonths.includes(month) ? 'selected' : ''}>${month}</option>`;
            });
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        updateMonthField();
    });

    document.getElementById('bonusType').addEventListener('change', updateMonthField);
</script>
@endsection --}}
