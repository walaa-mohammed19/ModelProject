<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function index()
    {
                return view('login');

    }

    public function getlogin()
    {

        if (Auth::guard('web')->check()){
            return redirect()->back();
        }
        return view('login');
    }

    public function postlogin(Request $request)
    {


        if (Auth::guard('web')->attempt([ 'email' => $request->get('email'), 'password' => $request->get('password')])) {
            if (Auth::guard('web')->user()->type == 1) { //Student
                return redirect()->route('profile_student');
            } else {
                return redirect()->route('profle_teacher');
//                return redirect()->back();
            }
        }

        else{
//            session()->flash('error_login',trans('admin.fail'));
            return redirect()->back();
        }
    }
    public function logout()
    {

        // Session::flush();
        Auth::guard('web')->logout();
        return view('login');
    }


}
