@extends('layouts.app') 
@section('title')
  Attendance Page
@endsection

@section('content')
<div class="my-5"></div>
<div class="row">
    <div class="col-md-10 offset-md-1"> {{-- Centering the content --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Attendance List</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered text-center">
                  <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($attendanceStatuses as $attendance)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $attendance['user_name'] }}</td>
                            <td>{{ $attendance['status'] }}</td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
