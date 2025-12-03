<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .company-info {
            margin-top: 10px;
        }

        .slip-info {
            display: grid;
            grid-template-columns: auto auto auto auto;
            grid-gap: 10px;
            margin: 30px auto;
            width: 80%;
        }

        table {
            width: 80%;
            margin: 70px auto 20px auto;
            border-collapse: collapse;
            border: 1px solid black;
        }

        th {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            background: lightgray;
        }

        td {
            border-left: 1px solid black;
            border-right: 1px solid black;
            padding: 8px;
        }

        .amount, .total {
            text-align: right;
        }

        body {
            margin: 20px;
        }
    </style>
</head>
<body>
    <img src="{{ asset('images/DKG-logo.png') }}" alt="" width="300px">
    <div class="company-info">
        <h2>SmartHR</h2>
        <p>190 Pearson Point Road</p>
        <p>Port Washington, PA 19047</p>
        <p>267-343-3409</p>
        <p>smartHR@payroll.com</p>
    </div>

    <div class="slip-info">
        <p><strong>Payslip ID:</strong> {{ $payroll->payrollID }}</p>

        <p><strong>Employee ID:</strong> {{ $employeeInfo->employeeID }}</p>

        <p><strong>Employee Name:</strong> {{ $employeeInfo->firstName }} {{ $employeeInfo->lastName }}</p>

        <p><strong>Company Name:</strong> {{ $employeeInfo->companyName }}</p>

        <p><strong>Designation:</strong> {{ $employeeInfo->designationName }}</p>

        <p><strong>Department:</strong> {{ $employeeInfo->departmentName }}</p>

        <p><strong>Pay Period:</strong> {{ $payroll->payStart }} to {{ $payroll->payEnd }}</p>
        
        <p><strong>Pay Date:</strong> {{ $payroll->payEnd }}</p>

        <p><strong>Days Worked:</strong> {{ $daysWorked }}</p>
    </div>

    <table>
        <tr>
            <th>Earnings</th>
            <th>Amount</th>
            <th>Deductions</th>
            <th>Amount</th>
        </tr>
        <tr>
            <td>Basic Salary</td>
            <td class="amount">${{ number_format($payroll->grossPay, 2) }}</td>
            <td>Tax</td>
            <td class="amount">${{ number_format($payroll->deductions, 2) }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="total">Total Earnings</td>
            <td class="amount">{{ $payroll->grossPay }}</td>
            <td class="total">Total Deductions</td>
            <td class="amount">{{ $payroll->deductions }}</td>
        </tr>
        <tr>
            <td></td>
            <td class="amount"></td>
            <td class="total"><strong>Net Pay</strong></td>
            <td class="amount"><strong>${{ number_format($payroll->payment, 2) }}</strong></td>
        </tr>
    </table>

    <p style="text-align: center">This is a system generated payslip.</p>
</body>
</html>