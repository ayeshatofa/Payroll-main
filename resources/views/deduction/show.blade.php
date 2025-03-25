@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Deduction Details</h2>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $deduction->name }}</h5>
            <p><strong>Rate:</strong> {{ $deduction->rate }}%</p>
            
            <p><strong>Applicable Grades:</strong> 
                @if ($deduction->gradeNumbers)
                    {{ implode(', ', json_decode($deduction->gradeNumbers)) }}
                @else
                    No specific grades assigned.
                @endif
            </p>

            <a href="{{ route('deduction.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('deduction.edit', $deduction->id) }}" class="btn btn-primary">Edit</a>

            <form action="{{ route('deduction.destroy', $deduction->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
