@extends('layout.employee')

@section('content')
<div class="container mt-5">
    <div class="card shadow p-4">
        <h4 class="mb-4 text-center">Request for Leave</h4>

        <form action="{{ route('leave.submit') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Start Date</label>
                <input type="datetime-local" name="leaveStart" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>End Date</label>
                <input type="datetime-local" name="leaveEnd" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Reason</label>
                <textarea name="reason" class="form-control" rows="4" required></textarea>
            </div>

            <button class="btn btn-primary w-100">Submit Request</button>
        </form>
    </div>
</div>
@endsection
