<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\CategorySurvey;
use App\Models\Survey;
use App\Models\SurveyAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;

class SurveyAnswerController extends Controller
{
    public function index($code)
    {
        $options = Helper::option_array();
        $category = CategorySurvey::where('code', $code)->first();
        $surveys = Survey::where([
            ['id_category', $category['id']],
            ['status', 1],
        ])->get();
        return view('content.surveys.answer.v_answer_survey', compact('surveys', 'options', 'category'));
    }

    public function store(Request $request)
    {
        $data = [];
        for ($i = 1; $i <= $request['amount']; $i++) {
            $answer = $request['val-' . $i];
            $value = NULL;
            if ($request['type-' . $i] == 'option') {
                $answer = Helper::get_option($request['val-' . $i]);
                $value = $request['val-' . $i];
            }
            $data[] = [
                'id_category' => $request['id_category'],
                'id_survey' => $request['key-' . $i],
                'answer' => $answer,
                'value' => $value,
                'created_at' => now(),
                'id_user' => Auth::guard('user')->user()->id,
            ];
        }
        SurveyAnswer::insert($data);
        return redirect()->route('survey.category')
            ->with('success', 'Survey berhasil dijawab');
    }
}
