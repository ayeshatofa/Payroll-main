
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <div class="card shadow-lg border-0 rounded glass-effect">
                <div class="card-header text-center py-4 bg-gradient">
                    <h2 class="fw-bold">Edit Profile</h2>
                </div>

                <div class="card-body p-4">
                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Form to Edit Profile -->
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name Field -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control custom-input" value="{{ old('name', $user->name) }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-group">
                                <label for="image" class="form-label">Profile Image</label>
                                <input type="file" name="image" id="image" class="form-control custom-input" accept="image/*" onchange="previewImage(event)">
                                
                                <div class="mt-3">
                                    <img src="{{ $user->image ? asset('storage/profile_images/' . $user->image) : asset('images/default-profile.png') }}" 
                                         id="imagePreview" width="120" height="120" 
                                         class="rounded-circle border border-3 border-primary object-fit-cover" 
                                         alt="Current Profile Image">
                                </div>
                            </div>
                        </div>

                        <!-- Address Field -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address" id="address" class="form-control custom-input" value="{{ old('address', $user->address) }}">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Deduction Selection -->
                        <div class="mb-4">
                            <label for="deduction_id" class="form-label">Deductions</label>
                            <div class="deduction-box">
                                @foreach ($deductions as $deduction)
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="deduction_id[]" id="ded_{{ $deduction->id }}" value="{{ $deduction->id }}" 
                                            class="form-check-input"
                                            {{ in_array($deduction->id, old('deduction_id', $user->deductions->pluck('id')->toArray())) ? 'checked' : '' }}>
                                            
                                        <label for="ded_{{ $deduction->id }}" class="form-check-label">{{ $deduction->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('deduction_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-gradient w-100">
                                Update Profile
                            </button>
                        </div>
                    </form>
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
        background: linear-gradient(135deg, #ff6a00, #ee0979);
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    /* Input Fields */
    .custom-input {
        border-radius: 8px;
        padding: 12px;
        border: 1px solid #ccc;
        transition: 0.3s ease-in-out;
    }

    .custom-input:focus {
        border-color: #ee0979;
        box-shadow: 0 0 8px rgba(238, 9, 121, 0.3);
    }

    /* Button */
    .btn-gradient {
        background: linear-gradient(135deg, #ff6a00, #ee0979);
        border: none;
        color: white;
        padding: 12px;
        font-size: 1rem;
        border-radius: 8px;
        transition: 0.3s;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, #ee0979, #ff6a00);
        transform: scale(1.05);
    }

    /* Deduction Box */
    .deduction-box {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.1);
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
</style>
@endsection
