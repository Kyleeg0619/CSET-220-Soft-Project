@extends('layout.employee')
<style>
    div nav {
            background: none;
        }

    #export {
        text-decoration: none;
        color: var(--vivid-blue);
        padding: 8px 13px;
        border-radius: 20px;
        font-weight: bold;
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
<div class="info_cell">Download</div>
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
<div class="info_cell">
    <a href="{{ url('/employee/payroll/export/'.$payroll->payrollID) }}" id="export" target="_blank"> 
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
  <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
</svg>
    </a>
</div>
</div>
@endforeach
    <div>
        {{ $history->links('pagination::bootstrap-5') }}
    </div>
</div> 
</main>
@endsection