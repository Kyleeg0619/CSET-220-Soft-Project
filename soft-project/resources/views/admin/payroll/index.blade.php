@extends('layout.layout')

@section('content')
<h1>Payroll Records</h1>

<form action="{{ route('payroll.generate') }}" method="POST">
    @csrf
    <label>Pay Period Start:</label>
    <input type="date" name="payStart" value="{{ now()->startOfMonth()->toDateString() }}">
    <label>Pay Period End:</label>
    <input type="date" name="payEnd" value="{{ now()->endOfMonth()->toDateString() }}">
    <button type="submit">Generate Payroll</button>
</form>

<table>
    <thead>
        <tr>
            <th>Employee</th>
            <th>Gross Pay</th>
            <th>Overtime Hours</th>
            <th>Deductions</th>
            <th>Payment</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payrolls as $p)
        <tr>
            <td>{{ $p->employee->firstName }} {{ $p->employee->lastName }}</td>
            <td>${{ number_format($p->grossPay, 2) }}</td>
            <td>{{ $p->overtimeHours }}</td>
            <td>${{ number_format($p->deductions, 2) }}</td>
            <td>${{ number_format($p->payment, 2) }}</td>
            <td>{{ $p->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
