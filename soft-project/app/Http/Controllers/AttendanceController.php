<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
        protected function todayDateString()
    {
        return Carbon::today('America/New_York')->toDateString();
    }

    public function dashboard()
    {
        $employee = Auth::guard('employee')->user();

        $attendance = Attendance::where('employeeID', $employee->employeeID)
                                ->orderBy('scheduleDate', 'desc')
                                ->get();
        return view('attendance', compact('attendance'));
    }

    public function clockIn()
    {
        $employee = Auth::guard('employee')->user();

        $alreadyClockedIn = Attendance::where('employeeID', $employee->employeeID)
                            ->where('scheduleDate', $this->todayDateString())
                            ->whereNull('clockOut')
                            ->first();

        if($alreadyClockedIn) {
            return redirect()->route('attendance')->with('msg' , 'You have already clocked in today.');
        }

        Attendance::create([
            'employeeID'  => $employee->employeeID, // ✅ correct
            'scheduleDate'=> $this->todayDateString(),
            'clockIN'     => now()->setTimezone('America/New_York')
        ]);

        return redirect()->route('attendance')->with('msg', 'Successfully clocked in!');
    }


    public function clockOut()
    {
        $employee = Auth::guard('employee')->user();
        $record = Attendance::where('employeeID', $employee->employeeID)
                    ->where('scheduleDate', $this->todayDateString())
                    ->whereNull('clockOut')
                    ->first();

        if(!$record){
            return redirect()->route('attendance')->with('msg','You have not clocked in today.');
        }

        $clockIn  = Carbon::parse($record->clockIN)->setTimezone('America/New_York');
        $clockOut = now()->setTimezone('America/New_York');

        $minutes = $clockIn->diffInMinutes($clockOut);
        $hoursDecimal = round($minutes / 60, 2);

        $record->update([
            'clockOut'   => $clockOut,
            'totalHours' => $hoursDecimal
        ]);

        return redirect()->route('attendance')->with('msg','Successfully clocked out!');
    }
}