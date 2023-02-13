<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        if (Auth::guard('admin')->check()) {
            session()->put('role', 'admin');
            session()->put('id', Auth::guard('admin')->user()->id);
        }
        if (Auth::guard('user')->check()) {
            session()->put('role', 'user');
            session()->put('id', Auth::guard('user')->user()->id);
        }
        return view('content.dashboard.v_admin');
    }

    // public function user()
    // {
    //     return view('content-users.dashboard.v_dashboard');
    // }
}
