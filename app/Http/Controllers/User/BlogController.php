<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\CategoryOther;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = DB::table('blogs')
            ->select('blogs.*', 'users.name as name_user', 'users.file as file_user', 'admins.name as name_admin', 'admins.file as file_admin')
            ->leftJoin('admins', function ($join) {
                $join->on('admins.id', '=', 'blogs.id_user')
                    ->where('blogs.role', '=', 'admin');
            })
            ->leftJoin('users', function ($join) {
                $join->on('users.id', '=', 'blogs.id_user')
                    ->where('blogs.role', '=', 'user');
            })
            // ->get();
            ->paginate(3);

        $categories = CategoryOther::where([
            ['type', 'blog'],
            ['status', '!=', 0]
        ])->withCount('blogs')->get();
        return view('content.guest.blogs.v_blog', compact('blogs', 'categories'));
    }
}
