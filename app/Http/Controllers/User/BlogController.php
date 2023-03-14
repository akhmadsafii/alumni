<?php

namespace App\Http\Controllers\User;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Models\CategoryOther;
use App\Traits\Nestcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    use Nestcode;

    public function index(Request $request)
    {
        $sort_search = null;
        $blog = Blog::latest()->where('status', '!=', 0);
        if ($request->search != null) {
            $blog = $blog->where('title', 'like', '%' . $request->search . '%');
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
        $this->countBlogView($title);
        $raw_blog = Blog::where('blogs.code', $title)->get();
        $blog = BlogResource::collection($raw_blog)->resolve();
        $blog = reset($blog);
        return view('content.guest.blogs.v_detail_blog', compact('blog'));
    }
}
