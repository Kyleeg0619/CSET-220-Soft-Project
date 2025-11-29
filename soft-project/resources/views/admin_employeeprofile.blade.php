@extends('layout.layout')

    <style>
        body { margin: 0; font-family: Arial; background: #f2f3f5; }
        .page-wrapper { margin-left: 260px; padding: 30px 40px; }


        .back-btn {
            display: inline-block;
            margin-bottom: 15px;
            padding: 8px 14px;
            background: #ead9ef;
            border-radius: 10px;
            text-decoration: none;
            color: black;
            font-weight: bold;
        }
        .back-btn:hover { background: #ddc7e6; }

        .last-updated { float: right; font-size: 14px; color: #888; margin-top: -30px; }

        .profile-top {
            display: flex; align-items: center;
            gap: 20px; margin-bottom: 25px;
        }

        .profile-pic {
            width: 100px; height: 100px; border-radius: 50%;
            overflow: hidden; background: #ddd;
            border: 4px solid #d4bfd6;
        }
        .profile-pic img { width: 100%; height: 100%; object-fit: cover; }

        .employee-id { font-size: 18px; color: #444; font-weight: bold; }

        .form-grid {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 25px; margin-top: 20px;
        }

        label { font-size: 14px; color: #555; font-weight: bold; }
        input, select {
            width: 100%; padding: 14px;
            background: #ececec; border-radius: 10px;
            border: none; font-size: 16px; margin-top: 6px;
        }

        .full-row { grid-column: span 2; }

        .upload-btn {
            background: #e6d6e6;
            padding: 6px 14px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 10px;
            display: inline-block;
        }
        .upload-btn:hover { background: #d4bfd2; }

        .save-btn {
            margin-top: 35px; background: #1e4cff;
            color: white; padding: 14px 28px;
            border: none; border-radius: 30px;
            font-size: 18px; cursor: pointer;
            font-weight: bold;
        }

        .save-btn:hover { background: #1536c7; }

        .alert {
            padding: 12px 18px; background: #d9ffd9;
            border-left: 5px solid #28a745;
            border-radius: 8px; margin-bottom: 15px;
            color: #2e6b32; font-weight: bold;
        }

        div nav {
            background: none;
        }
    </style>

@section('template-content')
<div class="page-wrapper">

    <a href="/admin/employeeoverview" class="back-btn">← Back to Overview</a>

    @if(session('success'))
    <div class="alert">{{ session('success') }}</div>
    @endif

    <div>
        <div class="header-title">Employee Profile</div>
        <div class="header-sub">View and manage employee information</div>
        <div class="last-updated">Last updated: {{ date('F d, Y') }}</div>
    </div>

    <div class="profile-card">

        <div class="profile-top">
            <div class="profile-pic">
                <img src="{{ $employee->profilePhoto 
                    ? asset('employee_photos/' . $employee->profilePhoto)
                    : asset('images/default-user.png') }}">
            </div>

            <div>
                <div class="employee-id">
                    Employee ID: <strong>{{ $employee->employeeID }}</strong>
                </div>

                <label class="upload-btn">
                    Change Photo
                    <input type="file" name="profilePhoto" form="updateForm" accept="image/*" hidden>
                </label>
            </div>
        </div>

        <form id="updateForm" action="{{ route('employee.profile.update', $employee->employeeID) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-grid">

                <div>
                    <label>First Name</label>
                    <input name="firstName" value="{{ $employee->firstName }}">
                </div>

                <div>
                    <label>Last Name</label>
                    <input name="lastName" value="{{ $employee->lastName }}">
                </div>

                <div class="full-row">
                    <label>Email</label>
                    <input name="email" value="{{ $employee->email }}">
                </div>

                <div>
                    <label>Department</label>
                    <select name="departmentID">
                        @foreach($departments as $dep)
                            <option value="{{ $dep->departmentID }}"
                                {{ $employee->departmentID == $dep->departmentID ? 'selected' : '' }}>
                                {{ $dep->departmentName }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Salary</label>
                    <input name="salary" value="{{ $employee->salary }}">
                </div>

                <div class="full-row">
                    <label>Designation</label>
                    <select name="designationID">
                        @foreach($designations as $des)
                            <option value="{{ $des->designationID }}"
                                {{ $employee->designationID == $des->designationID ? 'selected' : '' }}>
                                {{ $des->designationName }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <button class="save-btn">Save Changes</button>

        </form>

    </div>

    <div class="profile-card">
        <div class="header-title">Attendance</div>
        <div class="header-sub">View attendance history</div>
        <table class="employee-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Clock In</th>
                    <th>Clock Out</th>
                    <th>Total Hours</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendanceRecords as $record)
                <tr>
                    <td>{{ date('F d, Y', strtotime($record->scheduleDate)) }}</td>
                    <td>{{ $record->clockIN ? date('h:i A', strtotime($record->clockIn)) : '—' }}</td>
                    <td>{{ $record->clockOut ? date('h:i A', strtotime($record->clockOut)) : '—' }}</td>
                    <td>{{ $record->totalHours }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div>
                {{ $attendanceRecords->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <div class="profile-card">
        <div class="header-title">Payroll</div>
        <div class="header-sub">View payroll history</div>
        <table class="employee-table">
            <thead>
                <tr>
                    <th>Pay Period Start</th>
                    <th>Pay Period End</th>
                    <th>Payment</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payrolls as $payroll)
                <tr>
                    <td>{{ date('F d, Y', strtotime($payroll->payStart)) }}</td>
                    <td>{{ date('F d, Y', strtotime($payroll->payEnd)) }}</td>
                    <td>${{ number_format($payroll->payment, 2) }}</td>
                    <td>{{ $payroll->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div>
                {{ $payrolls->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@endsection

