<?php

namespace App\Http\Controllers;

use App\Models\CommentDiscussion;
use Illuminate\Http\Request;

class CommentDiscussionController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
        $data = $request->toArray();
        $data['role'] = session('role');
        $data['id_user'] = session('id');
        CommentDiscussion::updateOrCreate(
            ['id' => $request->id],
            $data
        );
        return response()->json([
            'message' => 'Komentar berhasil disimpan',
            'status' => true,
        ], 200);
    }
}
