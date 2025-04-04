@extends('layouts.app') 
@section('title')
    Position Page
@endsection

@section('content')
<div class="my-5"></div>
<div class="row">
    <div class="col-md-10 offset-md-1"> {{-- Centering the content --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Position List</h4>
                <a href="{{ route('position.create') }}" class="btn btn-primary">+ Add Position</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th> 
                            <th>Position ID</th>
                            <th>Position Name</th>
                            {{-- <th>Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($positions as $position) 
                            <tr>
                                <td>{{ $loop->iteration }}</td> 
                                <td>{{ $position->id }}</td>
                                <td>{{ $position->name }}</td>
                                {{-- <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('position.edit', $position->id) }}" class="btn btn-success me-2">Edit</a> --}}
                                        {{-- <a href="{{ route('position.show', $department->dep_id) }}" class="btn btn-info me-2">Show</a>
                                    </div>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
