@extends('layout.employee')
<style>
    div nav {
            background: none;
        }
</style>
@section('content')
<main>
<h1>Payroll</h1>
<div class="information_row" style="font-weight: bold;">
<div class="info_cell">Payroll ID</div>
<div class="info_cell">Pay Period</div>
<div class="info_cell">Gross Pay</div>
<div class="info_cell">Overtime</div>
<div class="info_cell">Deductions</div>
<div class="info_cell">Payment</div>
<div class="info_cell">Status</div>
</div>
<div class="payroll_history">
@foreach($history as $payroll)
<div class="information_row">
<div class="info_cell">{{$payroll->payrollID}}</div>
<div class="info_cell">{{$payroll->payStart}} <strong>to</strong> {{ $payroll->payEnd }}</div>
<div class="info_cell">${{$payroll->grossPay}}</div>
<div class="info_cell">{{$payroll->overtimeHours}}</div>
<div class="info_cell">{{$payroll->deductions}}</div>
<div class="info_cell">${{$payroll->payment}}</div>
<div class="info_cell">{{ $payroll->status }}</div>
</div>
@endforeach
    <div>
        {{ $history->links('pagination::bootstrap-5') }}
    </div>
</div> 
</main>
@endsection