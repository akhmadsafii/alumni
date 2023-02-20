<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CategorySurvey;
use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function category()
    {
        $categories =  CategorySurvey::withCount('surveys')->paginate(12);
        // dd($categories);
        return view('content.guest.surveys.v_category', compact('categories'));
    }

    public function survey($code)
    {
        $category = CategorySurvey::where('code', $code)->first();
        $surveys = Survey::where([
            ['id_category', $category['id']],
            ['status', '!=', 0]
        ])->get();
        return view('content.guest.surveys.v_survey', compact('surveys'));
        // dd($surveys);
    }
}
