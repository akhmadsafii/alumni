<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Blog;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', '!=', 0)->limit(4)->get();
        $agendas = Agenda::where('status', '!=', 0)->limit(5)->get();
        // dd($agendas);
        return view('content.guest.v_home', compact('blogs', 'agendas'));
    }
    public function discussion()
    {
        return view('content.guest.v_discussion');
    }

    public function alumni()
    {
        return view('content.guest.v_alumni');
    }
}
