@extends('layouts.app') 
@section('title')
    Bonus Details
@endsection

@section('content')
<div class="my-5"></div>
<div class="row">
    <div class="col-md-8 offset-md-2"> {{-- Center the card --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Bonus Details</h4>
                <a href="{{ route('bonus.index') }}" class="btn btn-primary">Back to Bonus List</a>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h5 class="text-muted">Bonus Name</h5>
                    <p class="fw-bold">{{ $bonus->name }}</p>
                </div>

                {{-- Display users under the same grade --}}
                <div class="mb-3">
                    <h5 class="text-muted">Users under the same bonus</h5>
                    @if($users->count() > 0)
                        <ul class="list-group">
                            @foreach($users as $user)
                                <li class="list-group-item">{{ $user->name }} ({{ $user->email }})</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No users found in this grade.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

