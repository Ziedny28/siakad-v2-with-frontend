<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    //show login page
    public function login()
    {
        return view('login.login');
    }

    //login process
    public function processLogin(Request $request)
    {
        //geting necessary data and validate it
        $credentials = $request->validate($this->credentialRules);

        //if success login as teacher ,user can access route that accessable by teacher and redirected to dashboard-teacher
        if (Auth::guard('teacher')->attempt($credentials)) {
            $request->session()->regenerate();
            Alert::success('Login Success', 'Welcome Teacher');
            return redirect('/dashboard-teacher');
        }

        //if success login as teacher ,user can access route that accessable by admin and redirected to dashboard-admin
        elseif (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            Alert::success('Login Success', 'Welcome Admin');
            return redirect('/dashboard-admin');
        }
        //if success login as teacher ,user can access route that accessable by student and redirected to dashboard-student
        elseif (Auth::guard('student')->attempt($credentials)) {
            $request->session()->regenerate();
            Alert::success('Login Success', 'Welcome Student');
            return redirect('/dashboard-student');
        }
        //if failed login user will be redirect to login page and can't access any route
        Alert::error('Login Failed', 'NI or Password is wrong');
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    //proses logout
    public function logout()
    {
        //logout from all guard
        if (Auth::guard('teacher')->check()) {
            Auth::guard('teacher')->logout();
        } elseif (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('student')->check()) {
            Auth::guard('student')->logout();
        }

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }

    private $credentialRules = [
        'ni' => ['required', 'string', 'max:255'],
        'password' => ['required', 'string', 'max:255'],
    ];
}
