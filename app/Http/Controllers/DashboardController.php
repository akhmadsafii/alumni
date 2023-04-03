<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        // dd(Auth::guard('admin')->user()->file);
        if (Auth::guard('admin')->check()) {
            session()->put('role', 'admin');
            session()->put('id', Auth::guard('admin')->user()->id);
            session()->put('avatar', Auth::guard('admin')->user()->file == null ? asset('asset/img/user4.jpg') : asset(Auth::guard('admin')->user()->file));
        }
        if (Auth::guard('user')->check()) {
            session()->put('role', 'user');
            session()->put('id', Auth::guard('user')->user()->id);
            session()->put('avatar', Auth::guard('user')->user()->file == null ? asset('asset/img/user4.jpg') : asset(Auth::guard('user')->user()->file));
        }
        return view('content.dashboard.v_admin');
    }

    // public function user()
    // {
    //     return view('content-users.dashboard.v_dashboard');
    // }
}
