<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Models\Admin;
use App\Models\CommentDiscussion;
use App\Models\Discussion;
use App\Models\User;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function index()
    {
        session()->put('title', 'Diskusi');
        $list_discussions = Discussion::orderBy('id', 'DESC')->where('status', '!=', 0)->get();
        $discussions = [];
        foreach ($list_discussions as $ld) {
            if ($ld['role'] == 'user') {
                $user = User::find($ld['id_user']);
            } else {
                $user = Admin::find($ld['id_user']);
            }
            $comments = CommentDiscussion::where([
                ['id_discussion', $ld['id']],
                ['status', '!=', 0],
            ])->get();
            $comment = [];
            foreach ($comments as $cm) {
                if ($cm['role'] == 'user') {
                    $user_comment = User::find($ld['id_user']);
                } else {
                    $user_comment = Admin::find($ld['id_user']);
                }
                $comment[] = [
                    'id' => $cm['id'],
                    'comment' => $cm['comment'],
                    'created_at' => DateHelper::timeHuman($cm['created_at']),
                    'name' => $user_comment['name'],
                    'file' => $user_comment['file'] != null ? asset($user_comment['file']) : asset('asset/img/user4.jpg'),
                ];
            }
            $discussions[] = [
                'id' => $ld['id'],
                'content' => $ld['content'],
                'created_at' => DateHelper::timeHuman($ld['created_at']),
                'name' => $user['name'],
                'file' => $user['file'] != null ? asset($user['file']) : asset('asset/img/user4.jpg'),
                'comment' => $comment
            ];
        }
        // dd($discussions);
        return view('content.discussions.v_discussion', compact('discussions'));
    }

    public function store(Request $request)
    {
        $data = $request->toArray();
        $data['role'] = session('role');
        $data['id_user'] = session('id');
        Discussion::updateOrCreate(
            ['id' => $request->id],
            $data
        );
        return response()->json([
            'message' => 'Diskusi berhasil disimpan',
            'status' => true,
        ], 200);
    }

    public function update(Request $request)
    {
        $discussion = Discussion::find($request->id);
        $discussion->update(array('content' => $request->content));
        return response()->json([
            'message' => 'Diskusi berhasil diupdate',
            'status' => true,
        ], 200);
    }

    public function detail(Request $request)
    {
        $discussion = Discussion::find($request['id']);
        return response()->json($discussion);
    }

    public function delete(Request $request)
    {
        $discussion = Discussion::find($request->id);
        $discussion->update(array('status' => 0));
        return response()->json([
            'message' => 'Diskusi berhasil dihapus',
            'status' => true,
        ], 200);
    }
}
