<?php

namespace App\Http\Controllers\User;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CategorySurvey;
use App\Models\Survey;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function category()
    {
        $all_categories =  CategorySurvey::where('status', 1)->get();
        $answer_question = 0;
        $filled_state = false;
        $login = false;
        $categories = [];
        foreach ($all_categories as $category) {
            if (Auth::guard('user')->check()) {
                $login = true;
                $answer_question = $category->answers->where('id_category', $category['id'])->where('id_user', Auth::guard('user')->user()->id)->count();
                $filled_state = $category->surveys->count() == $category->answers->where('id_category', $category['id'])->where('id_user', Auth::guard('user')->user()->id)->count() ? true : false;
            }
            $categories[] = [
                'id' => $category->id,
                'name' => $category->name,
                'code' => $category->code,
                'total_pertanyaan' => $category->surveys->count(),
                'pertanyaan_dijawab' => $answer_question,
                'status_terisi' => $filled_state,
                'login' => $login
            ];
        }
        // dd($categories);
        $categories = Helper::paginate($categories)->setPath(route('survey.category'));


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

    public function get_category(Request $request)
    {
        $category = CategorySurvey::where('code', $request['code'])->first();
        $category['total_question'] = $category->surveys->where('status', '!=', 0)->count();
        $category['total_essay'] = $category->surveys->where('type', 'teks')->where('status', '!=', 0)->count();
        $category['total_option'] = $category->surveys->where('type', 'option')->where('status', '!=', 0)->count();
        return response()->json($category);
    }
}
