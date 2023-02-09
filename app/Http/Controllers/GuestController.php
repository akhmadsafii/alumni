<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        return view('content.guest.v_home');
    }
    public function discussion()
    {
        return view('content.guest.v_discussion');
    }
}
