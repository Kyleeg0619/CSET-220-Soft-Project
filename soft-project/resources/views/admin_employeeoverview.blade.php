<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Overview</title>
    <style>
        .admin-ui {
            display: flex;
            height: 100vh;
            font-family: Arial, sans-serif;
        }
        .admin-nav {
            width: 220px;
            background-color: #e9dce7;
            padding: 20px;
        }
        .admin-nav h1, .admin-nav h3 {
            margin: 10px 0;
            color: black;
        }
        .admin-nav .dashboard-links {
            text-decoration: none;
            display: block;
        }
        .admin-nav .active h3 {
            font-weight: bold;
        }
        .admin-main {
            flex-grow: 1;
            padding: 30px;
        }
        .employee-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .filters {
            display: flex;
            gap: 10px;
        }
        .filter-btn, .search-bar, .insert-btn, .edit-btn, .delete-btn {
            background-color: #f3e9ef;
            border: none;
            border-radius: 15px;
            padding: 8px 14px;
            font-weight: bold;
            cursor: pointer;
        }
        .employee-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .employee-table th, .employee-table td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
        .actions {
            margin-top: 10px;
        }

        .search-container {
    display: flex;
    align-items: center;
    gap: 8px;
        }
        .search-btn {
    background-color: #d6c2d3;
    border: none;
    border-radius: 15px;
    padding: 8px 14px;
    font-weight: bold;
    cursor: pointer;
        }
        .search-btn:hover {
    background-color: #c3aebe;
        }
        
    .view-btn {
    background-color: #d9cde3;
    border: none;
    border-radius: 15px;
    padding: 6px 12px;
    cursor: pointer;
    font-weight: bold;
    text-decoration: none;
    color: black;
}
.view-btn:hover {
    background-color: #c5b2d1;
}
    </style>
</head>
<body>
    <main class="admin-ui">
        <section class="admin-nav">
            <a href="/admin/dashboard" class="dashboard-links"><h1>Dashboard</h1></a>
            <hr class="nav-spacer">
            <a href="/admin/employeeoverview" class="dashboard-links active"><h3>Employees</h3></a>
            <a href="/admin/attendance" class="dashboard-links"><h3>Attendance & Statistics</h3></a>
            <a href="/admin/leaverequests" class="dashboard-links"><h3>Leave Requests</h3></a>
        </section>

        <section class="admin-main">
            <header class="employee-header">
                <h2><strong>Employee</strong> Overview</h2>
                <div class="filters">
                <a href="{{ url('admin/employeeoverview?sort=departmentName&order=asc') }}" class="filter-btn">Department ▼</a>
                <a href="{{ url('admin/employeeoverview?sort=lastName&order=asc') }}" class="filter-btn">Name ▼</a>
                <a href="{{ url('admin/employeeoverview?sort=salary&order=asc') }}" class="filter-btn">Salary ▼</a>
                <div class="search-container">
                <input type="text" class="search-bar" placeholder="Search...">
                <button class="search-btn">Search</button>
                </div>
            </header>

            <div class="actions">
                <a href="{{ url('/admin/createEmployee') }}" class="insert-btn">Insert</a>
            </div>

            <table class="employee-table">
                <thead>
                    <tr>
                        <th>LastName, FirstName</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Salary</th>
                        <th>Password</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $emp)
                    <tr>
                        <td>{{ $emp->lastName }}, {{ $emp->firstName }}</td>
                        <td>{{ $emp->email }}</td>
                        <td>{{ $emp->departmentName ?? '—' }}</td>
                        <td>{{ $emp->designationName ?? '—' }}</td>
                        <td>${{ number_format($emp->salary, 0) }}</td>
                        <td>********</td>
                        <td>
                            <a href="{{ url('/admin/viewemployee/'.$emp->employeeID) }}" class="view-btn">View</a>
                            <a href="{{ url('/admin/editemployee/'.$emp->employeeID) }}" class="edit-btn">Edit</a>
                            <a href="{{ url('/admin/deleteemployee/'.$emp->employeeID) }}" 
                            class="delete-btn" 
                            onclick="return confirm('Are you sure you want to delete this employee?')">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector(".search-bar");
    const searchButton = document.querySelector(".search-btn");
    const tableBody = document.querySelector(".employee-table tbody");

    if (!searchInput || !searchButton || !tableBody) {
        console.error("Search elements not found");
        return;
    }

    function filterRows() {
        const filter = searchInput.value.trim().toLowerCase();
        const rows = tableBody.querySelectorAll("tr");

        rows.forEach(row => {
            const rowText = row.innerText.toLowerCase();
            row.style.display = rowText.includes(filter) ? "" : "none";
        });
    }

    searchButton.addEventListener("click", filterRows);
    searchInput.addEventListener("keydown", e => {
        if (e.key === "Enter") filterRows();
    });
});
</script>
</body>
</html>

