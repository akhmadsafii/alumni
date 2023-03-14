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

    public function detail_category($code)
    {
        // dd($code);
        $category = CategorySurvey::where('code', $code)->first();
        $options = Helper::option_array();
        $surveys = SurveyAnswer::join('category_surveys as cs', 'cs.id', '=', 'survey_answers.id_category')
            ->join('surveys as sv', 'sv.id', '=', 'survey_answers.id_survey')
            ->where([
                ['survey_answers.id_category', $category['id']],
                ['survey_answers.status', 1],
                ['survey_answers.id_user', Auth::guard('user')->user()->id],
            ])
            ->select('survey_answers.*', 'cs.name as category', 'sv.question as question', 'sv.type as type')
            ->get();
        return view('content.surveys.answer.v_detail_answer', compact('surveys', 'options', 'category'));
    }
}
