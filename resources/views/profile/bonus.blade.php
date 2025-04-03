@extends('layouts.app')

@section('title')
    Profile Bonus
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="mb-4">
                <h4 class="text-muted">Bonus List</h4>
                @if($bonuses->count() > 0)
                    <div class="table-responsive">
                        <table class="table custom-table mt-3">
                            <thead class="bg-gradient text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Bonus Type</th>
                                    <th>Rate</th>
                                    <th>Month</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bonuses as $bonus)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $bonus->name }}</td>
                                        <td>{{ $bonus->bonusType }}</td>
                                        <td>{{number_format($bonus->rate, 2) }}</td>
                                        <td>
                                            @php
                                                $month = json_decode($bonus->month);
                                            @endphp
                                            @if(is_array($month) && in_array(null, $month))
                                                Optional
                                            @elseif($month && !empty($month))
                                                {{ implode(', ', $month) }}
                                            @else
                                                Not Assigned
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-warning">No Bonuses found.</p>
                @endif
            </div>
            
                
        </div>
    </div>
@endsection