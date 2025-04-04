{{-- @extends('layouts.app')

@section('title')
    DashBoard
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Search</h4>
            <a href="{{ route('admin.search') }}" class="btn btn-primary">Search</a>
        </div>
        <h1>This is the admin dashboard</h1>
    </div>
@endsection --}}
@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h2>Admin Dashboard</h2>
                <a href="{{ route('admin.search') }}" class="btn btn-primary">Search</a>
            </div>

            <!-- Overview Cards -->
            <div class="row">
                <div class="col-md-3">
                    <div class="card shadow-sm p-3 mb-4">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text display-6">120</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm p-3 mb-4">
                        <h5 class="card-title">New Reports</h5>
                        <p class="card-text display-6">15</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm p-3 mb-4">
                        <h5 class="card-title">Active Sessions</h5>
                        <p class="card-text display-6">30</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm p-3 mb-4">
                        <h5 class="card-title">Feedback List</h5>
                        <p class="card-text display-6">Here you can see your employees feedback</p>
                        <a href="{{ route('feedback.indexAdmin') }}" class="btn btn-primary">Click</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .sidebar {
        height: 100vh;
    }
    .card {
        transition: transform 0.3s ease-in-out;
    }
    .card:hover {
        transform: scale(1.05);
    }
</style>
@endsection
