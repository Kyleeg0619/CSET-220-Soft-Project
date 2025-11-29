<?php

namespace App\Http\Controllers;

use App\Models\Leaverequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LeaveController extends Controller
{
    public function requestForm()
    {
        return view('leave.request');
    }

    public function submitRequest(Request $request)
    {
        $request->validate([
            'leaveStart' => ['required', 'date_format:Y-m-d\TH:i'],
            'leaveEnd'   => ['required', 'date_format:Y-m-d\TH:i', 'after_or_equal:leaveStart'],
            'reason'     => ['required', 'string']
        ]);

        $employee = Auth::guard('employee')->user();

        if (!$employee) {
            abort(403, "Not logged in as employee.");
        }

        $tz = config('app.timezone');
        $start = Carbon::createFromFormat('Y-m-d\TH:i', $request->leaveStart, $tz)->toDateTimeString();
        $end   = Carbon::createFromFormat('Y-m-d\TH:i', $request->leaveEnd, $tz)->toDateTimeString();

        Leaverequest::create([
            'employeeID'     => $employee->employeeID,
            'companyID'      => $employee->companyID,
            'reason'         => $request->reason,
            'leaveStart'     => $start,
            'leaveEnd'       => $end,
            'submissionDate' => now(),
            'approvalStatus' => 'PENDING'
        ]);

        return redirect()->route('leave.history')->with('msg', 'Leave Request Submitted.');
    }

    public function history()
    {
        $employee = Auth::guard('employee')->user();

        $requests = Leaverequest::where('employeeID', $employee->employeeID)
            ->orderBy('submissionDate', 'desc')
            ->get();

        return view('leave.history', compact('requests'));
    }
}
