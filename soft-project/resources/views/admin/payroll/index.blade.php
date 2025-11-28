@extends('layout.layout')

@section('template-content')
<h1>Payroll Records</h1>

<form action="{{ route('payroll.generate') }}" method="POST" style="margin-bottom: 20px;">
    @csrf
    <button type="submit" style="padding: 10px 20px; font-size: 16px;">Generate 2-Week Payroll</button>
</form>

<table style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr style="background-color: #f0f0f0; text-align: left;">
            <th style="padding: 12px 15px;">Employee</th>
            <th style="padding: 12px 15px;">Gross Pay</th>
            <th style="padding: 12px 15px;">Overtime Hours</th>
            <th style="padding: 12px 15px;">Deductions</th>
            <th style="padding: 12px 15px;">Payment</th>
            <th style="padding: 12px 15px;">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payrolls as $p)
        <tr style="border-bottom: 1px solid #ddd;">
            <td style="padding: 10px 15px;">
                @if($p->employee)
                    {{ $p->employee->firstName }} {{ $p->employee->lastName }}
                @else
                    <span style="color:red;">(Employee Missing)</span>
                @endif
            </td>
            <td style="padding: 10px 15px;">${{ number_format($p->grossPay, 2) }}</td>
            <td style="padding: 10px 15px;">{{ $p->overtimeHours }}</td>
            <td style="padding: 10px 15px;">${{ number_format($p->deductions, 2) }}</td>
            <td style="padding: 10px 15px;">${{ number_format($p->payment, 2) }}</td>
            <td style="padding: 10px 15px;">{{ $p->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
