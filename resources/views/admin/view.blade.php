@extends('layouts.app')

@section('title')
    Search Page
@endsection

@section('content')
<div class="my-5"></div>
<div class="row">
  <div class="col-md-10 offset-md-1">
    <div class="card-header text-dark text-center">
        <h4 class="mb-2">User Search Results</h4>
    </div>
    <!-- Results Table -->
    <div class="table-responsive mt-5">
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
                @forelse($users as $user)
                    @if ($user->role == 'admin')
                        @continue
                    @endif
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->position}}</td>
                        <td>{{ $user->departments->dep_name }}</td>
                        <td>{{ $user->date_of_join}}</td>
                        <td>
                            <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('attendance.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit Attendance</a>
                            <form action="{{ route('admin.destroy', $user->id) }}" method="post" class="d-inline" onsubmit="return confirm('Are you sure to delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No users found matching your criteria.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
</div>
</div>
</div>
@endsection
