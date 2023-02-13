<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\CategorySurvey;
use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        session()->put('title', 'Survey');
        $categories = CategorySurvey::where('status', '!=', 0)->get();
        return view('content.surveys.v_survey', compact('categories'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $data = $request->toArray();
        if ($request->type == 'option') {
            foreach (Helper::option_array() as $key => $val) {
                $data['option' . $key] = $val;
            }
        }
        // dd($data);
        $data['code'] = str_slug($data['question']) . '-' . Helper::str_random(5);
        Survey::updateOrCreate(
            ['id' => $request->id],
            $data
        );
        return response()->json([
            'message' => 'Survey berhasil disimpan',
            'status' => true,
        ], 200);
    }

    public function detail($code)
    {
        $category = CategorySurvey::where('code', $code)->first();
        session()->put('title', $category['name']);
        $surveys = Survey::where([
            ['id_category', $category['id']],
            ['status', '!=', 0],
        ])->get();
        return view('content.surveys.v_detail_survey', compact('surveys', 'category'));
    }

    public function delete(Request $request)
    {
        $survey = Survey::find($request->id);
        $survey->update(array('status' => 0));
        return response()->json([
            'message' => 'Survey berhasil dihapus',
            'status' => true,
        ], 200);
    }
}
