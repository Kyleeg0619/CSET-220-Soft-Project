@extends('layout.admin')
@section('content')
            <div class="form-section">
                <form action="/admin/employeeCreated" method="post" class="register-form" style="width:80%;">
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
                <label for="employee_type">Employment Type: </label>
                <select name="employee_type" id="">
                    <option value="part-time">Part-Time</option>
                    <option value="full-time">Full-Time</option>
                    <option value="contract">Contract</option>
                </select>
                <label for="salary_type">Salary Type: </label>
                <select name="salary_type" id="">
                    <option value="hourly">Hourly</option>
                    <option value="monthly">Monthly/Salary</option>
                </select>
                <label for="rate">Salary: </label>
                <input type="number" name="rate" min="0.00">
                <button type="submit" class="form-submit">Create</button>
                </form>
                </div>
                    @if(isset($success))
                <p class="success">{{ $success }}</p>
                @endif

@endsection