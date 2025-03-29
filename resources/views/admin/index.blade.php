@extends('layout.master')

@section('title')
    DashBoard
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Search</h4>
            <a href="{{ route('admin.search') }}" class="btn btn-primary">Search</a>
        </div>
    </div>
@endsection