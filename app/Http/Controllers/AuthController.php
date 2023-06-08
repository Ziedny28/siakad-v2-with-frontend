<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    //menampilkan halaman login
    public function login()
    {
        return view('login.login');
    }

    //proses login
    public function processLogin(Request $request)
    {
        //mengambil data yang diperlukan dan melakukan validasi
        $credentials = $request->validate([
            'ni' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ]);

        //jika berhasil login sebagai teacher maka dapat mengakses route yang dapat diakses oleh teacher
        if (Auth::guard('teacher')->attempt($credentials)) {
            $request->session()->regenerate();
            Alert::success('Login Success', 'Welcome Teacher');
            return redirect('/dashboard-teacher');
        }

        //jika berhasil login sebagai admin maka dapat mengakses route yang dapat diakses oleh admin
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            Alert::success('Login Success', 'Welcome Admin');
            return redirect('/dashboard-admin');
        }

        //jika berhasil login sebagai student maka dapat mengakses route yang dapat diakses oleh student
        if (Auth::guard('student')->attempt($credentials)) {
            $request->session()->regenerate();
            Alert::success('Login Success', 'Welcome Student');
            return redirect('/dashboard-student');
        }

        //jika gagal login maka akan dikembalikan ke halaman login dan tidak mendapat hak akses apapun
        Alert::error('Login Failed', 'NI or Password is wrong');
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    //proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('/login');
    }
}
