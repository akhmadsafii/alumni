<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function category()
    {
        $categories =  CategorySurvey::withCount('surveys')->paginate(12);
        return view('content.guest.surveys.v_category', compact('categories'));
    }
}
