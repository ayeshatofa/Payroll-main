@extends('layouts.app') 
@section('title')
    Department Page
@endsection

@section('content')
<div class="my-5"></div>
<div class="row">
    <div class="col-md-10 offset-md-1"> {{-- Centering the content --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Department List</h4>
                <a href="{{ route('department.create') }}" class="btn btn-primary">+ Add Department</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Department ID</th>
                            <th>Department Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department) 
                            <tr>
                                <td>{{ $department->dep_id }}</td>
                                <td>{{ $department->dep_name }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('department.edit', $department->dep_id) }}" class="btn btn-success me-2">Edit</a>
                                        <a href="{{ route('department.show', $department->dep_id) }}" class="btn btn-info me-2">Show</a>
                                        <form action="{{ route('department.destroy', $department->dep_id) }}" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this department?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
