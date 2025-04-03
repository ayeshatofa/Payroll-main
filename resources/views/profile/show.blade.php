@extends('layouts.app')

@section('title')
    {{ $user->name }}'s Profile
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <!-- Profile Card -->
            <div class="card shadow-lg border-0 rounded glass-effect">
                <div class="card-header text-center py-4 bg-gradient position-relative">
                    <div class="profile-image-container mx-auto">
                        <img src="{{$user->image ? asset('storage/profile_images/' . $user->image) : asset('images/default-profile.png')}}" alt="{{ $user->name }}'s Profile Picture" class="profile-image">
                    </div>
                    <h2 class="fw-bold text-dark mt-3">{{ $user->name }}</h2>
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-light text-dark">{{ $user->position }}</span>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- User Info -->
                    <div class="mb-4">
                        <h4 class="text-muted">Profile Details</h4>
                        <p><strong>📧 Email:</strong> {{ $user->email }}</p>
                        <p><strong>💼 Position:</strong> {{ $user->position }}</p>
                        <p><strong>📍 Address:</strong> {{ $user->address }}</p>
                    </div>

                  
                    <!-- Edit Profile Button -->
                    <div class="text-center">
                        <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-gradient w-100">
                            Edit Profile
                        </a>
                    </div><div class="text-center mt-3">
                        <a href="{{ route('password.request') }}" class="btn btn-gradient w-100">
                            Change Password
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Included (If Not Already in Layout) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom Styling -->
<style>
    /* Glass Effect */
    .glass-effect {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    /* Gradient Header */
    .bg-gradient {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    /* Table Styling */
    .custom-table thead {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        color: white;
        border-radius: 10px;
    }

    /* Button */
    .btn-gradient {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        border: none;
        color: white;
        padding: 12px;
        font-size: 1rem;
        border-radius: 8px;
        transition: 0.3s;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, #2575fc, #6a11cb);
        transform: scale(1.05);
    }

    /* Salary Box */
    .salary-box .list-group-item {
        font-size: 1.1rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .glass-effect {
            padding: 10px;
        }
        .btn-gradient {
            font-size: 0.9rem;
            padding: 10px;
        }
    }
    /* Profile Image */
    .profile-image-container {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 3px solid rgba(255, 255, 255, 0.3);
        padding: 3px;
        background: rgba(255, 255, 255, 0.1);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .profile-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        transition: transform 0.3s;
    }

    .profile-image-container:hover {
        transform: scale(1.05);
        border-color: rgba(255, 255, 255, 0.5);
    }

</style>
@endsection
