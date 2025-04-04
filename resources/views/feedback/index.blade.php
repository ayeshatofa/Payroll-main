@extends('layouts.app') 
@section('title')
    Feedback Page
@endsection

@section('content')
<div class="my-5"></div>
<div class="row">
    <div class="col-md-10 offset-md-1"> {{-- Centering the content --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Feedback List</h4>
                <a href="{{ route('feedback.create') }}" class="btn btn-primary">+ Add Feedback</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th> 
                            <th>Description</th>
                            <th>Date of Submission</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feedbacks as $feedback) 
                            <tr>
                                <td>{{ $loop->iteration }}</td> 
                                <td>{{ $feedback->description }}</td>
                                <td>{{ $feedback->date_of_submission }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
