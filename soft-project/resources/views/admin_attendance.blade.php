@extends('layout.admin')

<style>
    div nav {
            background: none;
        }
</style>

@section('content')

<div class="profile-card" style="border: 1px solid var(--deep-navy)">
    <div class="header-title">Attendance</div>
    <div class="header-sub">Oversee Day-to-Day Employee Attendance</div>
    <form action="/admin/attendance/filter" method="POST" class="attendance-filter">
        @csrf
        <label for="start_date">Start Date:</label>
        <input type="date" id="startDate" name="startDate" required>
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="endDate" required>
        <button type="submit" class="form-submit">Filter</button>
    </form>
    <table class="employee-table">
        <tr>
            <th>Employee ID</th>
            <th>Name</th>
            <th>Date</th>
            <th>Clock-In Time</th>
            <th>Clock-Out Time</th>
            <th>Total Hours</th>
        </tr>
        @foreach ($attendanceRecords as $record)
        <tr>
            <td>{{ $record->employeeID }}</td>
            <td>{{ $record->lastName }}, {{ $record->firstName }}</td>
            <td>{{ $record->scheduleDate }}</td>
            <td>{{ $record->clockIN }}</td>
            <td>{{ $record->clockOut }}</td>
            <td>{{ $record->totalHours }}</td>
        </tr>
        @endforeach
    </table>
    @if (isset($error))
        <p class="error">{{ $error }}</p>
    @endif
    <div>
        {{ $attendanceRecords->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection