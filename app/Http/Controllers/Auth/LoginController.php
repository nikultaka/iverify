<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use Session;

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
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    
    public function signin(Request $request)
    {
        if (!$request->isMethod('post')) {
            return view('auth.login');

        }

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'email'                 => 'required|email',
                // 'password'              => 'required|min:8|max:20|regex:/^[A-Za-z0-9 ]+$/|alpha_dash',
                'password'              => 'required|min:8|max:20',

            ]);
            $credentials = $request->only('email', 'password');
            $credentials['status'] = 1;

            if (Auth::attempt($credentials) && Auth::user()->role_id == 1) { // Admin (company)
                Session::put('login_user_role',Auth::user()->role);
                return redirect()->route('admin.dashboard');
        
            // elseif (Auth::attempt($credentials) && Auth::user()->role_id == 2) {  // Hr
            //     Session::put('login_user_role', 'hr');
            //     return redirect()->route('hr.dashboard');
            // } elseif (Auth::attempt($credentials) && Auth::user()->role_id == 3) { // employee
            //     Session::put('login_user_role', 'employee');
            //     return redirect()->route('employee.dashboard');
            // } elseif (Auth::attempt($credentials) && Auth::user()->role_id == 4) { // supervisor
            //     Session::put('login_user_role', 'supervisor');
            //     return redirect()->route('supervisor.dashboard');
            // } elseif (Auth::check() && Auth::user()->role_id == 5) { // superadmin
            //     Session::put('login_user_role', 'superadmin');
            //     return redirect()->route('superadmin.dashboard');
            }  else {
                return redirect('/signin')->with('error', 'Incorrect username or password.');
            }
        }
    }

    public function logoutUser()
    {
        Auth::logout();
        return redirect('/login');
    }
}
