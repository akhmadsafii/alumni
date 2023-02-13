<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function index()
    {
        session()->put('title', 'Diskusi');
        return view('content.discussions.v_discussion');
    }
}
