@extends('layouts.app') 
@section('title')
  Bonus Page
@endsection

@section('content')
<div class="my-5"></div>
<div class="row">
    <div class="col-md-10 offset-md-1"> {{-- Centering the content --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Bonus List</h4>
                <a href="{{ route('bonus.create') }}" class="btn btn-primary">+ Add New Bonus</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered text-center">
                  <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Bonus Type</th>
                        <th>Month</th>
                        <th>Rate</th>
                        <th>Grade Numbers</th>
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($bonuses as $bonus)
                          <tr>
                              <td>{{ $bonus->id }}</td>
                              <td>{{ $bonus->name }}</td>
                              <td>{{ $bonus->bonusType }}</td>
                              <td>{{ $bonus->month }}</td>
                              <td>{{ $bonus->rate }}</td>
                              <td>
                                  @if($bonus->gradeNumbers)
                                      {{ implode(', ', json_decode($bonus->gradeNumbers, true)) }}
                                  @else
                                      N/A
                                  @endif
                              </td>
                              <td>
                                  <a href="{{ route('bonus.edit', $bonus->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                  
                                  {{-- <form action="{{ route('bonus.destroy', $bonus->id) }}" method="POST" class="d-inline" 
                                        onsubmit="return confirm('Are you sure you want to delete this bonus?');">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                  </form> --}}
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
