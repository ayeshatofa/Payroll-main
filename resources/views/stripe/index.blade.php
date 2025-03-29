@extends('layout.master')

@section('title')
    Search Page
@endsection

@section('content')
<div class="my-5"></div>
<div class="row">
  <div class="col-md-10 offset-md-1">
        <div class="card">
            @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
            @endif
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Position</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->position}}</td>
                                <td>
                                    @if($user->has_paid)
                                        <span class="badge bg-success">Paid</span>
                                    @else
                                        <a href="{{ route('stripe.create', $user->id) }}" class="btn btn-warning btn-sm">Pay</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection