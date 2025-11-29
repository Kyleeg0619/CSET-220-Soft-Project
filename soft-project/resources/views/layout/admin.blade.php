@extends('layout.layout')
 @section('template-content')
<section class="admin-ui">
    <section class="admin-nav">
            <a href="/admin/dashboard" class="dashboard-links">
                <h1>Dashboard</h1>
            </a>
            <hr class="nav-spacer" style="border-color: var(--periwinkle);border-width:2.5px;margin-bottom:10px;">
            <a href="/admin/employeeoverview" class="dashboard-links"><h3>Employees</h3></a>
            <a href="/admin/attendance" class="dashboard-links"><h3>Attendance</h3></a>
            <a href="/admin/leaverequests" class="dashboard-links"><h3>Leave Requests</h3></a>
            <a href="/admin/payroll" class="dashboard-links"><h3>Payroll</h3></a>
    </section>
    <section class="admin-content">

        @yield('content')

    </section>
</section>
@endsection