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
    var selectedMonths = @json(old('month', json_decode($bonus->month, true) ?? []));
    
    monthField.innerHTML = ''; // Clear previous options
    
    if (bonusType === 'Monthly') {
        // Set "Every" as the only option for Monthly
        monthField.innerHTML = '<option value="Every" selected>Every</option>';
        // monthField.setAttribute('disabled', 'disabled'); // Disable field for Monthly
    } else if (bonusType === 'Half-yearly') {
        monthField.removeAttribute('disabled');
        monthField.setAttribute('multiple', 'multiple');

        let months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        months.forEach(month => {
            monthField.innerHTML += `<option value="${month}" ${selectedMonths.includes(month) ? 'selected' : ''}>${month}</option>`;
        });
    } else if (bonusType === 'Annually') {
        monthField.removeAttribute('disabled');
        monthField.removeAttribute('multiple');

        let months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        months.forEach(month => {
            monthField.innerHTML += `<option value="${month}" ${selectedMonths.includes(month) ? 'selected' : ''}>${month}</option>`;
        });
    }
}

// Call the function on page load
document.addEventListener("DOMContentLoaded", function() {
    updateMonthField();
});

// Attach event listener for the bonusType dropdown
document.getElementById('bonusType').addEventListener('change', updateMonthField);


</script>
@endsection