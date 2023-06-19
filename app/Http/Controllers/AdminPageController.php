<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPageController extends Controller
{

    function adminProfile()
    {
        $admin = Admin::find(Auth::guard('admin')->user()->id);
        return view('admin.my-profile', compact('admin'));
    }
}
