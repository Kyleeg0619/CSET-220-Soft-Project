@extends('layout.admin')

@section('content')
<style>
    div nav {
        background: none;
    }
</style>


            <table class="leave-block" style="position: relative">
                <tr>
                    <td colspan="8">
                        <h1>Leave Requests</h1>
                    </td>
                </tr>
                <tr>
                    <td colspan="8">
                        <p>Review and manage employee leave applications</p>
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                <tr>
                    @php
                        $currentSort = request('sort');
                        $currentDir = request('direction','desc');
                        $baseUrl = url('/admin/leaverequests');
                        function toggleDir($col, $currentSort, $currentDir) {
                            if ($currentSort === $col) {
                                return $currentDir === 'asc' ? 'desc' : 'asc';
                            }
                            // default to asc when switching columns
                            return 'asc';
                        }
                    @endphp

                    <th><a href="{{ $baseUrl }}?sort=employeeID&direction={{ toggleDir('employeeID',$currentSort,$currentDir) }}">Employee ID{{ $currentSort=='employeeID' ? ($currentDir=='asc' ? ' ▲' : ' ▼') : '' }}</a></th>
                    <th><a href="{{ $baseUrl }}?sort=name&direction={{ toggleDir('name',$currentSort,$currentDir) }}">Name{{ $currentSort=='name' ? ($currentDir=='asc' ? ' ▲' : ' ▼') : '' }}</a></th>
                    <th><a href="{{ $baseUrl }}?sort=reason&direction={{ toggleDir('reason',$currentSort,$currentDir) }}">Reason{{ $currentSort=='reason' ? ($currentDir=='asc' ? ' ▲' : ' ▼') : '' }}</a></th>
                    <th><a href="{{ $baseUrl }}?sort=submissionDate&direction={{ toggleDir('submissionDate',$currentSort,$currentDir) }}">Submission Date{{ $currentSort=='submissionDate' ? ($currentDir=='asc' ? ' ▲' : ' ▼') : '' }}</a></th>
                    <th><a href="{{ $baseUrl }}?sort=leaveStart&direction={{ toggleDir('leaveStart',$currentSort,$currentDir) }}">Leave Start{{ $currentSort=='leaveStart' ? ($currentDir=='asc' ? ' ▲' : ' ▼') : '' }}</a></th>
                    <th><a href="{{ $baseUrl }}?sort=leaveEnd&direction={{ toggleDir('leaveEnd',$currentSort,$currentDir) }}">Leave End{{ $currentSort=='leaveEnd' ? ($currentDir=='asc' ? ' ▲' : ' ▼') : '' }}</a></th>
                    <th><a href="{{ $baseUrl }}?sort=status&direction={{ toggleDir('status',$currentSort,$currentDir) }}">Status{{ $currentSort=='status' ? ($currentDir=='asc' ? ' ▲' : ' ▼') : '' }}</a></th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach ($employees as $employee)
                    <tr class="record-row">
                        <td>{{ $employee->employeeID }}</td>
                        <td>{{ $employee->lastName }}, {{ $employee->firstName }}</td>
                        <td>{{ $employee->reason }}</td>
                        <td>{{ $employee->submissionDate }}</td>
                        <td>{{ $employee->leaveStart }}</td>
                        <td>{{ $employee->leaveEnd }}</td>
                        <td>{{ $employee->approvalStatus }}</td>
                        @if ($employee->approvalStatus == 'Pending')
                        <td><a href="{{ route('approveRequest',['requestID'=>$employee->requestID]) }}" class="approve">Approve</a></td>
                        <td><a href="{{ route('denyRequest',$employee->requestID) }}" class="deny">Deny</a></td>
                        @endif
                    </tr>
                @endforeach
            </table>
            <div>
                {{ $employees->links('pagination::bootstrap-5') }}
            </div>
            <form action="/searchLeave" method="POST" class="search-leave">
                    @csrf
                    <input type="text" name="search" placeholder="Name..." class="search-input">
                    <button type="submit" class="search-submit">Search</button>
            </form>


@endsection