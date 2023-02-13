<?php

namespace App\Http\Controllers;

use App\Models\CategorySurvey;
use Illuminate\Http\Request;

class CategorySurveyController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->toArray();
        CategorySurvey::updateOrCreate(
            ['id' => $request->id],
            $data
        );
        return response()->json([
            'message' => 'Kategori berhasil disimpan',
            'status' => true,
        ], 200);
    }
}
