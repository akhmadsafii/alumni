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
        ])->orderBy('type', 'ASC')->get();
        $surveys = $surveys->toArray();
        // dd($surveys);

        $survey = [];
        $keys = array_keys($surveys);
        // dd($keys);
        foreach (array_keys($keys) as $index) {
            // dd($index);
            $current_key = current($keys);
            $current_value = $surveys[$current_key];
            $next_key = next($keys);
            $next_value = $surveys[$next_key] ?? null;
            $survey[] = [
                'current' => $current_value,
                'next' => $next_value,
            ];
        }
        // dd($survey);
        return view('content.guest.surveys.v_survey', compact('survey'));
    }
}
