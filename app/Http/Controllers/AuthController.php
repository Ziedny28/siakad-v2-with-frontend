<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        return view('login.login');
    }

    public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'ni' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('teacher')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard-teacher');
        }
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            Alert::success('Login Success', 'Welcome Admin');
            return redirect('/dashboard-admin');
        }
        if (Auth::guard('student')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard-student');
        }

        Alert::error('Login Failed', 'NI or Password is wrong');
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('/login');
    }
}
