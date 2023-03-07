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

    public function detail(Request $request)
    {
        $comment = CommentDiscussion::find($request['id']);
        return response()->json($comment);
    }

    public function delete(Request $request)
    {
        $comment = CommentDiscussion::find($request->id);
        $comment->update(array('status' => 0));
        return response()->json([
            'message' => 'Komentar berhasil dihapus',
            'status' => true,
        ], 200);
    }
}
