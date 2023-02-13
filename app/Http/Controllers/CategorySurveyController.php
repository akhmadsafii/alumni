<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\CategorySurvey;
use Illuminate\Http\Request;

class CategorySurveyController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->toArray();
        $data['code'] = str_slug($data['name']) . '-' . Helper::str_random(5);
        if ($request['id']) {
            unset($data['code']);
        }
        CategorySurvey::updateOrCreate(
            ['id' => $request->id],
            $data
        );
        return response()->json([
            'message' => 'Kategori berhasil disimpan',
            'status' => true,
        ], 200);
    }

    public function delete(Request $request)
    {
        $category = CategorySurvey::find($request->id);
        $category->update(array('status' => 0));
        return response()->json([
            'message' => 'Kategori Survei berhasil dihapus',
            'status' => true,
        ], 200);
    }

    public function detail(Request $request)
    {
        $category = CategorySurvey::find($request['id']);
        return response()->json($category);
    }
}
