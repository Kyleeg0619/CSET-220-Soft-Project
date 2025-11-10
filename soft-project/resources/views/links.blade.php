<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quick Links</title>
</head>
<body>
    <h1>Quick Links</h1>
    <ul>
        <li><a href="{{ url('/') }}">Welcome</a></li>
        <li><a href="{{ url('/template') }}">Template</a></li>
        <li><a href="{{ url('/login') }}">Login</a></li>
        <li><a href="{{ url('/verifyLogin') }}">Verify Login (POST)</a></li>
        <li><a href="{{ url('/admin/dashboard') }}">Admin Dashboard</a></li>
        <li><a href="{{ url('/admin/approveRequest/1') }}">Approve Request (Example)</a></li>
        <li><a href="{{ url('/admin/deniedRequest/1') }}">Deny Request (Example)</a></li>
        <li><a href="{{ url('/admin/createEmployee') }}">Create Employee</a></li>
        <li><a href="{{ url('/admin/employeeCreated') }}">Employee Created (POST)</a></li>
        <li><a href="{{ url('/about') }}">About</a></li>
        <li><a href="{{ url('/home') }}">Home</a></li>
    </ul>
</body>
</html>
