<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries =  Gallery::where([
            ['publish', 1],
            ['status', '!=', 0]
        ])->get();
        // dd($galleries);
        return view('content.guest.galleries.v_gallery', compact('galleries'));
    }
}
