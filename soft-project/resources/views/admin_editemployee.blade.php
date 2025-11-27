<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Employee</title>

    <style>
        body { font-family: Arial, sans-serif; background: #fafafa; margin:0; }

        .edit-container {
            width: 60%;
            margin: 40px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.1);
        }

        h2 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #ccc;
            margin-top: 5px;
            background: #f3e9ef;
            font-size: 16px;
        }

        .save-btn {
            margin-top: 20px;
            padding: 12px 18px;
            border: none;
            background: #d6c2d3;
            border-radius: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        .back-btn {
            margin-top: 10px;
            display: inline-block;
            text-decoration: none;
            color: black;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="edit-container">
        <h2>Edit Employee</h2>

        <form method="POST" action="{{ route('updateEmployee', $employee->employeeID) }}">
            @csrf

            <label>First Name</label>
            <input type="text" name="firstName" value="{{ $employee->firstName }}" required>

            <label>Last Name</label>
            <input type="text" name="lastName" value="{{ $employee->lastName }}" required>

            <label>Email</label>
            <input type="email" name="email" value="{{ $employee->email }}" required>

            <label>Department</label>
            <select name="departmentID" required>
                @foreach($departments as $dept)
                    <option value="{{ $dept->departmentID }}"
                        @if($dept->departmentID == $employee->departmentID) selected @endif>
                        {{ $dept->departmentName }}
                    </option>
                @endforeach
            </select>

            <label>Designation</label>
            <select name="designationID" required>
                @foreach($designations as $des)
                    <option value="{{ $des->designationID }}"
                        @if($des->designationID == $employee->designationID) selected @endif>
                        {{ $des->designationName }}
                    </option>
                @endforeach
            </select>

            <label>Salary ($)</label>
            <input type="number" name="salary" value="{{ $employee->salary }}" required>

            <button type="submit" class="save-btn">Save Changes</button>
        </form>

        <a href="/admin/employeeoverview" class="back-btn">← Back to Employee Overview</a>
    </div>

</body>
</html>
