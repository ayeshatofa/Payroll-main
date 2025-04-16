@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <main class="col-lg-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                <h1 class="h2">Admin Dashboard</h1>
                <a href="{{ route('admin.search') }}" class="btn btn-primary">
                    <i class="fas fa-search me-1"></i> Search
                </a>
            </div>

            <!-- Statistics Cards -->
            <div class="row g-4">
                <!-- Total Users Card -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card h-100 shadow-sm hover-effect">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-square bg-primary text-white rounded-3 me-3 p-3">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                                <div>
                                    <h5 class="card-title text-muted mb-1">Total Users</h5>
                                    <h2 class="mb-0">{{ $userCount }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Positions Card -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card h-100 shadow-sm hover-effect">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-square bg-success text-white rounded-3 me-3 p-3">
                                    <i class="fas fa-briefcase fa-2x"></i>
                                </div>
                                <div>
                                    <h5 class="card-title text-muted mb-1">Available Positions</h5>
                                    <a href="{{ route('position.index') }}" class="btn btn-link ps-0">
                                        Manage Positions <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attendances Card -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card h-100 shadow-sm hover-effect">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-square bg-info text-white rounded-3 me-3 p-3">
                                    <i class="fas fa-clock fa-2x"></i>
                                </div>
                                <div>
                                    <h5 class="card-title text-muted mb-1">Attendances</h5>
                                    <a href="{{ route('attendance.index') }}" class="btn btn-link ps-0">
                                        View Today's Log <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feedback Card -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card h-100 shadow-sm hover-effect">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-square bg-warning text-white rounded-3 me-3 p-3">
                                    <i class="fas fa-comments fa-2x"></i>
                                </div>
                                <div>
                                    <h5 class="card-title text-muted mb-1">Employee Feedback</h5>
                                    <a href="{{ route('feedback.indexAdmin') }}" class="btn btn-link ps-0">
                                        View Feedback <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
    .hover-effect {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .hover-effect:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175);
    }

    .icon-square {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
    }

    .card-title {
        font-size: 0.9rem;
        letter-spacing: 0.5px;
    }
</style>
@endsection