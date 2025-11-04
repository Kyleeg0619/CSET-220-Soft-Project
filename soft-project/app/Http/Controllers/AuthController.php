<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CompanyUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{


    public function viewLogin() {
        return view('login');
    }

    public function verifyLogin(Request $request) {
        $user = CompanyUsers::with(['department.company'])->where('email',$request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return Redirect::route('login')->with('warning','Invalid Credentials');
        }


        if (Hash::check($request->password, $user->password)) {
            session(['user'=>$user]);
            if ($user->userRole == 'admin') {
                return Redirect::route('admin/dashboard');
            } else {
                // return Redirect::route('employee/dashboard');
                return $user;
            }
        } else {
            return Redirect::route('login',['warning'=>'Invalid Credentials']);
        }
    }

}
