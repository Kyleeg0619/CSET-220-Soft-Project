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
                <div class="form-section">
                        <form action="/admin/employeeCreated" method="post" class="register-form" style="width:80%;display:block;">
                @csrf
                <h1>Create Employee</h1>
                <hr>
                <label for="firstName">First Name: </label>
                <input type="text" name="firstName">
                <label for="lastName">Last Name: </label>
                <input type="text" name="lastName">
                <label for="email">Email: </label>
                <input type="text" name="email">
                <label for="password">Password: </label>
                <input type="text" name="password">
                <label for="departmentID">Department: </label>
                <select name="departmentID" id="">
                    @foreach ($departments as $department)
                        <option value="{{ $department->departmentID }}">{{ $department->departmentName }}</option>
                    @endforeach
                </select>
                <label for="designationID">Designation: </label>
                <select name="designationID" id="">
                    @foreach ($designations as $designation)
                        <option value="{{ $designation->designationID }}">{{ $designation->designationName }}</option>
                    @endforeach
                </select>
                <label for="salary">Salary</label>
                <input type="number" name="salary">
                <button type="submit" class="form-submit">Create</button>
                        </form>
                    </div>
                    @if(isset($success))
                <p class="success">{{ $success }}</p>
                @endif
            </section>
    </section>

@endsection