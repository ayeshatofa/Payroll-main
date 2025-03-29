@extends('layouts.app') 
@section('title')
  Salary Page
@endsection

@section('content')
<div class="my-5"></div>
<div class="row">
    <div class="col-md-10 offset-md-1"> {{-- Centering the content --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Salary List</h4>
                <a href="{{ route('salary.create') }}" class="btn btn-primary">+ Add Department</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Salary ID</th>
                            <th>Basic Salary</th>
                            <th>Allowance</th>
                            <th>Total Salary</th>
                            <th>Grade</th>
                            <th>Tax Rate</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salaries  as $salary) 
                            <tr>
                                <td>{{ $salary->salary_id }}</td>
                                <td>{{ $salary->basic_salary}}</td>
                                <td>{{ $salary->allowance}}</td>
                                <td>{{ $salary->total_salary}}</td>
                                <td>{{ $salary->grade}}</td>
                                <td>{{ $salary->tax_rate}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('salary.edit', $salary->salary_id) }}" class="btn btn-success me-2">Edit</a>
                                        <a href="{{ route('salary.show', $salary->salary_id) }}" class="btn btn-info me-2">Show</a>
                                        <form action="{{ route('salary.destroy', $salary->salary_id) }}" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this salary?')">
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
