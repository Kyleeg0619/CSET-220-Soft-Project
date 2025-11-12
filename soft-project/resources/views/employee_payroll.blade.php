@extends('layout.layout')
@section('content')
<main>
<div class="information_row">
<div class="info_cell">Last Name</div>
<div class="info_cell">First Name</div>
<div class="info_cell">Month</div>
<div class="info_cell">Base Pay</div>
<div class="info_cell">Overtime Hours</div>
<div class="info_cell">Overtime Rate</div>
<div class="info_cell">Total Salary</div>
</div>
<div class="payroll_history">
@foreach($history as $payroll)
<div class="information_row">
<div class="info_cell">{{$employee->lastName}}</div>
<div class="info_cell">{{$employee->firstName}}</div>
<div class="info_cell">{{$payroll->month}}</div>
<div class="info_cell">${{$payroll->basepay}}</div>
<div class="info_cell">{{$payroll->overtimeHours}}</div>
<div class="info_cell">{{$payroll->otRate}}</div>
<div class="info_cell">${{$payroll->totalSalary}}</div>
</div>
@endforeach
</div> 
</main>
@endsection