@extends('layout.admin')

<style>
    p {
        margin-bottom: 0;
    }

.charts {
    display: flex;
    justify-content: space-between;
    gap: 30px;
    align-items: flex-start;/* align tops instead of centers if you want */
    margin: 15px 0;
    width: 100%;
}

.chart-container {
    flex: 1;           
    min-width: 0;
    height: 500px;
    border-radius: 20px;
    border: 1px solid var(--deep-navy);
    padding: 10px 10px 40px 10px;
    margin: 25px 0;
    text-align: center;
}
</style>

@section('content')
<h3>Welcome back, {{ $admin->firstName.' '.$admin->lastName }}</h3>
            <div class="stats">
                <div class="stat-card">
                    <p>Total Employees</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
  <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
</svg>
                    <p>{{ $totalEmployees }}</p>
                    
                </div>
                <div class="stat-card">
                    <p>Present Today</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
  <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
</svg>
                    <p>{{ $presentEmployees }}</p>
                </div>
                <div class="stat-card">
                    <p>Absent Today</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-person-dash" viewBox="0 0 16 16">
  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M11 12h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1m0-7a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
  <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
</svg>
                    <p>{{ $absentEmployees }}</p>
                </div>
                <div class="stat-card">
                    <p>Payroll This Month</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
  <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
  <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
  <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
</svg>
                    <p>${{ $totalPay }}</p>
                </div>
            </div>

            <div class="charts">
                <div class="chart-container">
                    <h4>Employee Attendance in Last Month</h4>
                    <canvas id="attendanceStats"></canvas>
                </div>
                <div class="chart-container">
                    <h4>Department Distribution</h4>
                    <canvas id="departmentStats"></canvas>
                </div>
            </div>

            <table class="leave-block">
                <tr>
                    <td colspan="8">
                        <h1>Recent Leave Requests</h1>
                    </td>
                </tr>
                <tr>
                    <td colspan="8">
                        <p>Review and manage employee leave applications</p>
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Reason</th>
                    <th>Submission Date</th>
                    <th>Leave Start</th>
                    <th>Leave End</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->employeeID }}</td>
                        <td>{{ $employee->lastName }}, {{ $employee->firstName }}</td>
                        <td>{{ $employee->reason }}</td>
                        <td>{{ $employee->submissionDate }}</td>
                        <td>{{ $employee->leaveStart }}</td>
                        <td>{{ $employee->leaveEnd }}</td>
                        <td>{{ $employee->approvalStatus }}</td>
                        <td><a href="{{ route('quickApproveRequest',['requestID'=>$employee->requestID]) }}" class="approve">Approve</a></td>
                        <td><a href="{{ route('quickDenyRequest',$employee->requestID) }}" class="deny">Deny</a></td>
                    </tr>
                @endforeach
            </table>

@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('attendanceStats').getContext('2d');
    const attendanceStats = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($dateArray) !!},
            datasets: [{
                label: 'Employees Present',
                data: {!! json_encode($presentArray) !!},
                fill: false,
                borderColor: [
                    'rgba(54, 162, 235, 1)'
                ],
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    ticks: {
                        callback: function(value, index, ticks) {
                            if (index === 0 || index === ticks.length - 1) {
                                return this.getLabelForValue(value);
                            }
                            return '';
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    precision:0
                }
            }
        }
    });

});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const deptCtx = document.getElementById('departmentStats').getContext('2d');
    const departmentStats = new Chart(deptCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($departmentNames) !!},
            datasets: [{
                label: 'Employees by Department',
                data: {!! json_encode($departmentCounts) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                    'rgba(255, 159, 64, 0.7)'
                ],
                borderColor: [
                    'rgba(255, 255, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Employees by Department'
                }
            }
        }
    });
});
</script>