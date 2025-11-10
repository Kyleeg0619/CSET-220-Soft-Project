@extends('layouts.layout')

@section('content')

<div class="container mt-4">
    
    @if(session('msg'))
        <div class="alert alert-info">{{ session('msg') }}</div>
    @endif


    <div class="d-flex justify-content-end mb-3 gap-3">
        <form action="{{ route('clock.in') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-secondary px-4 py-2 fw-bold">CLOCK-IN</button>
        </form>

        <form method ="POST" action="{{ route('clock.out') }}">
            @csrf
            <button type="submit" class="btn btn-danger px-4 py-2 fw-bold">CLOCK-OUT</button>

        </form>
    </div>

    <div class="card shadow-sm p-4">
        <h5 class="fw-bold mb-4">Attendance Overview</h5>

        <table class="table">
            <thead class='fw-bold'>
                <tr>
                    <th>Date</th>
                    <th>Clock-In Time</th>
                    <th>Clock-Out Time</th>
                    <th>Total Hours</th>
                </tr>
            </thead>

            <tbody>
                @foreach($attendance as $row)
                @php 
                    $clockIn = $row -> clockIN ? \Carbon\Carbon::parse($row -> clockIN) : null;
                    $clockOut = $row -> clockOut ? \Carbon\Carbon::parse($row -> clockOut) : null;
                @endphp

                <tr>
                    <td class='text-capitalize'>
                        {{ \Carbon\Carbon::parse($row ->scheduleDate) -> format('l M d') }}
                    </td>

                    <td>
                        @if($clockIn)
                            <span class='text-primary'>{{ $clockIn -> format('h:i A') }} </span>
                        @endif
                    </td>

                    <td>
                        @if($clockOut)
                            <span class='text-success'> {{ $clockOut -> format('h:i A') }} </span>
                        @else
                            <span class='text-danger'>--:-- --</span>
                        @endif
                    </td>

                    <td>
                        @if($row->totalHours)
                            @php 
                                $hrs = floor($row->totalHours);
                                $mins = round(($row->totalHours - $hrs) * 60 );
                            @endphp
                            {{ sprintf('%02d:%02d', $hrs, $mins) }}
                        @else
                            -- 
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection


