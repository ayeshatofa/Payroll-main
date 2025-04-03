@extends('layouts.app')

@section('title')
    Search Page
@endsection

@section('content')
<div class="my-5"></div>
<div class="row">
  <div class="col-md-10 offset-md-1">
        <div class="card">
            @if(session('msg'))
            <div class="alert alert-success">
                {{session('msg')}}
            </div>
            @endif
            <div class="card-header">
                <h4>Search Users</h4>
            </div>
            <div class="card-body">
                <!-- Search Form -->
                <form action="{{ route('admin.searchForm') }}" method="GET" class="mb-4">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" id="search-input" name="name" class="form-control" 
                                placeholder="Search by name..." value="{{ request('name') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-block">Search</button>
                        </div>
                    </div>
                    
                    <!-- Advanced Filters -->
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select name="department" id="department" class="form-control">
                                    <option value="">-- Departments --</option> 
                                    @foreach($departments as $department)
                                        <option value="{{ $department->dep_id }}" {{ request('department') == $department->dep_id ? 'selected' : '' }}>
                                            {{ $department->dep_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                         <div class="col-md-4">
                            <div class="form-group">
                                <label for="position">Position</label>
                                <select name="position" id="position" class="form-control">
                                    <option value="">-- Positions --</option> 
                                    @foreach($positions as $position)
                                        <option value="{{ $position->name }}" {{ request('position') == $position->name ? 'selected' : '' }}>
                                            {{ $position->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="date_of_join">Joined After</label>
                                <input type="date" name="date_of_join" class="form-control" value="{{ request('date_of_join') }}">
                            </div>
                        </div>
                    </div>
                </form>
                
                <!-- Results Table -->
                <div class="table-responsive">
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

@section('scripts')

<script>
    $(document).ready(function() {
        $("#search-input").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('autocomplete') }}",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2, // Start suggesting after 2 characters
            focus: function(event, ui) {
                // Prevent value insert on focus
                event.preventDefault();
                $(this).val(ui.item.label);
            },
            select: function(event, ui) {
                // Set the value when item is selected
                $(this).val(ui.item.label);
                return false;
            }
        }).autocomplete("instance")._renderItem = function(ul, item) {
            // Custom rendering if needed
            return $("<li>")
                .append("<div>" + item.label + "</div>")
                .appendTo(ul);
        };
    });
</script>
@endsection