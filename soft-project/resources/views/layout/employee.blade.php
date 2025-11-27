@extends('layout.layout')
 @section('template-content')
<section class="employee-ui">
    <section class="employee-nav">
            <a href="/employee/attendance" class="dashboard-links">
                <h1>Dashboard</h1>
            </a>
            <hr class="nav-spacer" style="border-color: var(--lavender);border-width:2.5px;margin-bottom:10px;">
            <a href="/employee/profile" class="dashboard-links"><h3>Profile</h2></a>
            <a href="/employee/attendance" class="dashboard-links"><h3>Attendance</h2></a>
    </section>
    <section class="employee-content">

        @yield('content')

    </section>
</section>
@endsection