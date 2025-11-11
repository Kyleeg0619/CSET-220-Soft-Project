<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    public function viewLogin() {
        return view('login');
    }

    public function verifyLogin(Request $request)
    {
        $role = $request->role;
        $user = $role == 'admin'
            ? Admin::where('email', $request->email)->first()
            : Employee::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return Redirect::route('login')->with('warning', 'Invalid Credentials');
        }

        $role == 'admin' ? Auth::guard('admin')->login($user) : Auth::guard('employee')->login($user);

        session(['role' => $role]);

        return $role == 'admin'
            ? Redirect::route('admin/dashboard')
            : Redirect::route('attendance');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('home'); // Redirects the user to the desired location after logout
    }

}
