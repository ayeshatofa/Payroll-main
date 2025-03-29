@extends('layout.master')

@section('title')
    Search Page
@endsection

@section('content')
<div class="my-5"></div>
<div class="row">
  <div class="col-md-10 offset-md-1">
        <div class="card">
            {{-- <div class="card-header d-flex justify-content-between align-items-center">
              <h4>Deduction List</h4>
              <a href="{{ route('deduction.create') }}" class="btn btn-primary">+ Add New Deduction</a>
            </div> --}}
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Position</th>
                            <th>Department Name</th>
                            <th>Date of Join</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->position}}</td>
                                <td>{{ $user->departments->dep_name }}</td>
                                <td>{{ $user->date_of_join}}</td>
                                <td>
                                    <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.destroy', $user->id) }}" method="post" class="d-inline" onsubmit="return confirm('Are you sure to delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection