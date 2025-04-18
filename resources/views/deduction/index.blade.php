@extends('layouts.app')

@section('title')
    Deductions List
@endsection

@section('content')
<div class="my-5"></div>
    <div class="row">
      <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h4>Deduction List</h4>
                  <a href="{{ route('deduction.create') }}" class="btn btn-primary">+ Add New Deduction</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Deduction ID</th>
                                <th>Name</th>
                                <th>Rate</th>
                                <th>Grade Numbers</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deductions as $deduction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td> 
                                    <td>{{ $deduction->id }}</td>
                                    <td>{{ $deduction->name }}</td>
                                    <td>{{ $deduction->rate }}</td>
                                    <td>
                                        @php
                                            $gradeNumbers = json_decode($deduction->gradeNumbers);
                                        @endphp
                                        @if(is_array($gradeNumbers) && in_array(null, $gradeNumbers))
                                            Optional
                                        @elseif($gradeNumbers && !empty($gradeNumbers))
                                            {{ implode(', ', $gradeNumbers) }}
                                        @else
                                            Not Assigned
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('deduction.edit', $deduction->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('deduction.show', $deduction->id) }}" class="btn btn-warning btn-sm">Show</a>
                                        <form action="{{ route('deduction.destroy', $deduction->id) }}" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this deduction?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
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
