@extends('layouts.app')

@section('title')
   Salary Page
@endsection

@section('content')
<div class="my-5"></div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    @if(session('msg'))
                        <div class="alert alert-success">
                            {{session('msg')}}
                        </div>
                    @endif
                    <form action="{{ route('salary.store') }}" method="post">
                        @csrf
                        
                        <div class="mb-5">
                            <label for="basic_salary">Basic Salary:</label>
                            <input type="number" name="basic_salary" id="basic_salary" class="form-control">
                            @error('basic_salary')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="allowance">Allowance:</label>
                            <input type="number" name="allowance" id="allowance" class="form-control" >
                            @error('allowance')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="tax_rate">Tax Rate:</label>
                            <input type="number" name="tax_rate" id="tax_rate" class="form-control" >
                            @error('tax_rate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="grade">Grade:</label>
                            <input type="number" name="grade" id="grade" class="form-control" >
                            @error('grade')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="position">Position: </label>
                            <select name="position[]" id="position" class="form-control" multiple>
                                @foreach($positions as $position)
                                    <option value="{{ $position }}" 
                                        {{ in_array($position, old('position', [])) ? 'selected' : '' }}>
                                        {{ $position }}
                                    </option>
                                @endforeach
                            </select>
                            @error('position')
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
