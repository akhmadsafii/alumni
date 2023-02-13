<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        session()->put('title', 'Survey');
        return view('content.surveys.v_survey');
    }
}
