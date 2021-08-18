<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/user_dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

//    public function getlogin()
//    {
//
//        if (Auth::guard('web')->check()){
//            return redirect()->back();
//        }
//        return view('auth_admin.login');
//    }
//
//    public function postlogin(Request $request)
//    {
//
//
//        if (Auth::guard('web')->attempt([ 'email' => $request->get('email'), 'password' => $request->get('password')])){
//    if (auth('web)->user()->type == 1)
//            return redirect()->to('admin/dashboard');
//        }else{
//            session()->flash('error_login',trans('admin.fail'));
//            return redirect()->back();
//        }
//    }
}
