@extends('layout.admin')
    <style>
        .employee-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .filters {
            display: flex;
            gap: 10px;
        }

        .filter-btn {
            text-wrap: nowrap;
        }

        .filter-btn, .insert-btn, .edit-btn, .delete-btn {
            background-color: var(--vivid-blue);
            border: none;
            border-radius: 30px;
            padding: 8px 14px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            color: var(--periwinkle)
        }

        .employee-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .employee-table th, .employee-table td {
            padding: 5px;
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
            background-color: var(--lavender);
            border: none;
            border-radius: 15px;
            padding: 8px 14px;
            font-weight: bold;
            cursor: pointer;
            color: var(--periwinkle);
        }
        
    .view-btn {
    background-color: var(--lavender);
    color: var(--periwinkle);
    border: none;
    border-radius: 15px;
    padding: 6px 12px;
    cursor: pointer;
    font-weight: bold;
    text-decoration: none;
}
.view-btn:hover {
    background-color: #c5b2d1;
}

.employee-overview {
    border: 1px solid var(--deep-navy);
    border-radius: 20px;
    padding: 20px;
}

.controls a {
    display: block;
    margin: 5px;
    text-align: center
}
    </style>

@section('content')
            <section class="employee-overview">
                <header class="employee-header">
                    <h2><strong>Employee</strong> Overview</h2>
                    <div class="filters">
                    <a href="{{ url('admin/employeeoverview?sort=departmentName&order=asc') }}" class="filter-btn">Department ▼</a>
                    <a href="{{ url('admin/employeeoverview?sort=lastName&order=asc') }}" class="filter-btn">Name ▼</a>
                    <a href="{{ url('admin/employeeoverview?sort=salary&order=asc') }}" class="filter-btn">Salary ▼</a>
                    <div class="search-container">
                    <input type="text" class="search-input search-bar" placeholder="Search...">
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
                            <td class="controls">
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

@endsection

