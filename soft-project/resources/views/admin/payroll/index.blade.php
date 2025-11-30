@extends('layout.admin')

<style>
    div nav {
            background: none;
        }

    .mark-all-pay {
        display: block;
        width: fit-content;
        background-color: var(--vivid-blue);
        border: none;
        border-radius: 30px;
        padding: 8px 14px;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
        color: var(--periwinkle);
        margin: 10px 0;
    }

    .mark-pay {
        display: inline-block;
        width: fit-content;
        background-color: var(--lavender);
        border: none;
        border-radius: 30px;
        padding: 8px 14px;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
        color: var(--periwinkle);
        margin: 10px 0;
    }
</style>

@section('template-content')
<h1>Payroll Records</h1>

<form action="{{ route('payroll.generate') }}" method="POST" style="margin-bottom: 20px;">
    @csrf
    <button type="submit" style="padding: 10px 20px; font-size: 16px;">Generate 2-Week Payroll</button>
</form>

<a href="/admin/payroll/markAllPayroll" class="mark-all-pay">Process All</a>

<table class="employee-table">
    <thead>
        <tr>
            <th>Employee</th>
            <th>Pay Period</th>
            <th>Gross Pay</th>
            <th>Overtime</th>
            <th>Deductions</th>
            <th>Payment</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payrolls as $p)
        <tr>
            <td>{{ $p->employee->firstName }} {{ $p->employee->lastName }}</td>
            <td>{{ $p->payStart }} to {{ $p->payEnd }}</td>
            <td>${{ number_format($p->grossPay, 2) }}</td>
            <td>{{ $p->overtimeHours }}</td>
            <td>${{ number_format($p->deductions, 2) }}</td>
            <td>${{ number_format($p->payment, 2) }}</td>
            <td>{{ $p->status }}</td>
            <td><a href="{{ url('/admin/payroll/mark/'.$p->payrollID) }}" class="mark-pay">Process</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
    <div>
        {{ $payrolls->links('pagination::bootstrap-5') }}
    </div>
@endsection
