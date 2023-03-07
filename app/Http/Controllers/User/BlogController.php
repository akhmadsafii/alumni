<?php

namespace App\Http\Controllers\User;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Models\CategoryOther;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $sort_search = null;
        $blog = Blog::latest()->where('status', '!=', 0);
        if ($request->search != null){
            $blog = $blog->where('title', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }
        $blog = $blog->get();
        $blogs = BlogResource::collection($blog)->resolve();
        $blogs = Helper::paginate($blogs)->setPath(route('blog.public'));


        $categories = CategoryOther::where([
            ['type', 'blog'],
            ['status', '!=', 0]
        ])->withCount('blogs')->get();
        return view('content.guest.blogs.v_blog', compact('blogs', 'categories', 'sort_search'));
    }

    public function detail($title)
    {
        // $blog = Blog::where('code', $code)->first();
        // dd($blog);

        $blog = Blog::where('blogs.code', $title) ->select('blogs.*', 'users.name as name_user', 'users.file as file_user', 'admins.name as name_admin', 'admins.file as file_admin')
        ->leftJoin('admins', function ($join) {
            $join->on('admins.id', '=', 'blogs.id_user')
                ->where('blogs.role', '=', 'admin');
        })
        ->leftJoin('users', function ($join) {
            $join->on('users.id', '=', 'blogs.id_user')
                ->where('blogs.role', '=', 'user');
        })->first();
        // dd($blog);
        return view('content.guest.blogs.v_detail_blog', compact('blog'));
    }
}
