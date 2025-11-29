@extends('layout.employee')

<style>
    .request-link {
        display: block;
        width: fit-content;
        background-color: var(--vivid-blue);
        border: none;
        border-radius: 30px;
        padding: 8px 14px;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
        color: var(--periwinkle);
        margin: 10px 0;
        justify-self: right;
    }
</style>

@section('content')
<div class="container mt-5">
    <h3 class="mb-3">Leave Requests</h3>

    <a href="/employee/leave/request" class="request-link">Request Leave</a>

    @if(session('msg'))
        <div class="alert alert-success text-center">{{ session('msg') }}</div>
    @endif

    <table class="table table-bordered table-hover text-center shadow">
        <thead class="table-dark">
            <tr>
                <th>Request ID</th>
                <th>Submission Date</th>
                <th>Leave Start</th>
                <th>Leave End</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($requests as $req)
                <tr>
                  <td>{{ $req->requestID }}</td>
                  <td>{{ $req->submissionDate }}</td>
                  <td>{{ $req->leaveStart }}</td>
                  <td>{{ $req->leaveEnd }}</td>
                  <td>{{ strtoupper($req->approvalStatus) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No leave requests found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
