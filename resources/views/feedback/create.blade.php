@extends('layouts.app') 
@section('title')
    Feedback Page
@endsection

@section('content')
<div class="my-5"></div>
    <div class="row">
        <div class="col-md-6 offset-md-3"> {{-- Centering the form --}}
            <div class="card">
                <div class="card-header">
                    <h4>Add New Feedback</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('feedback.store') }}" method="post">
                        @csrf
                        <div class="mb-5">
                            <label for="description">Description: </label>
                            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                            @error('description')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                        
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('feedback.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
