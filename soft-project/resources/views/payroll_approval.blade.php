@extends('layout.layout')
@section('content')
    <section class="admin-ui">
        <section class="admin-nav">
            <a href="/admin/dashboard" class="dashboard-links">
                <h1>Dashboard</h1>
            </a>
            <hr class="nav-spacer" style="border-color: var(--periwinkle);border-width:2.5px;margin-bottom:10px;">
            <a href="" class="dashboard-links"><h3>Employees</h2></a>
            <a href="/admin/leaverequests" class="dashboard-links"><h3>Leave Requests</h2></a>
        </section>
        <section class="admin-content">
            <table class="leave-block" style="position: relative">
                <tr>
                    <td colspan="6">
                        <h1>Payroll Approvals</h1>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <p>Review and approve employee payrolls</p>
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach ($payrolls as $payroll)
                    <tr>
                        <td>{{ $payroll->employeeID }}</td>
                        <td>{{ $payroll->lastName }}, {{ $payroll->firstName }}</td>
                        <td>{{ $payroll->month }}</td>
                        <td>{{ $payroll->year }}</td>
                        <td>{{ $payroll->status }}</td>
                        <td>
                            @if ($payroll->status == 'Pending')
                                <form method="POST" action="/admin/payrolls/{{ $payroll->id }}/approve" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="approve-button">Approve</button>
                                </form>
                                <form method="POST" action="/admin/payrolls/{{ $payroll->id }}/reject" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="reject-button">Reject</button>
                                </form>
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </section>
    </section>
@endsection