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
        return Carbon::today(config('app.timezone'))->toDateString();
    }

    public function dashboard()
    {
        if (session('role') !== 'employee') {
            abort(403, 'Access denied');
        }

        $attendance = Attendance::where('employeeID', Auth::id())
                                ->orderBy('scheduleDate', 'desc')
                                ->get();
        return view('attendance', compact('attendance'));
    }

    public function clockIn()
    {
        $alreadyClockedIn = Attendance::where('employeeID', Auth::id())
                            ->where('scheduleDate', $this->todayDateString())
                            ->whereNull('clockOut')
                            ->first();

        if($alreadyClockedIn) {
            return redirect()->route('attendance')->with('msg' , 'You have already clocked in today.');
        }

        Attendance::create([
            'employeeID'  => Auth::id(),
            'scheduleDate'=> $this->todayDateString(),
            'clockIN'     => now()->setTimezone(config('app.timezone'))
        ]);

        return redirect()->route('attendance')->with('msg', 'Successfully clocked in!');
    }

    public function clockOut()
    {
        $record = Attendance::where('employeeID', Auth::id())
                    ->where('scheduleDate', $this->todayDateString())
                    ->whereNull('clockOut')
                    ->first();

        if(!$record){
            return redirect()->route('attendance')->with('msg','You have not clocked in today.');
        }

        $clockIn  = Carbon::parse($record->clockIN)->setTimezone(config('app.timezone'));
        $clockOut = now()->setTimezone(config('app.timezone'));

        $minutes = $clockIn->diffInMinutes($clockOut);
        $hoursDecimal = round($minutes / 60, 2);

        $record->update([
            'clockOut'   => $clockOut,
            'totalHours' => $hoursDecimal
        ]);

        return redirect()->route('attendance')->with('msg','Successfully clocked out!');
    }
}
