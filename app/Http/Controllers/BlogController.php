<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Helpers\Helper;
use App\Helpers\ImageHelper;
use App\Helpers\StatusHelper;
use App\Models\Admin;
use App\Models\Blog;
use App\Models\CategoryOther;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        session()->put('title', 'Blog');
        $blogs = Blog::join('category_others', 'category_others.id', '=', 'blogs.id_category_other')
            ->select('blogs.*', 'category_others.name as category')
            ->where('blogs.status', '!=', 0);
        if ($request->ajax()) {
            return DataTables::of($blogs)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<span class="dropdown">
                        <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                            <i class="la la-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="' . route('admin.blog.detail', $row['code']) . '"><i class="la la-info-circle"></i> Detail</a>
                            <a class="dropdown-item" href="' . route('admin.blog.edit', $row['code']) . '"><i class="la la-pencil"></i> Ubah</a>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="deleteData(' . $row['id'] . ')"><i class="la la-trash"></i> Hapus</a>
                        </div>
                    </span>';
                    return $btn;
                })
                ->editColumn('title', function ($blog) {
                    $file = $blog['file'] ? asset($blog['file']) : asset('asset/img/user4.jpg');
                    return '<div class="m-widget3">
                    <div class="m-widget3__item mb-0">
                        <div class="m-widget3__header">
                            <div class="m-widget3__user-img mb-0">
                                <img class="m-widget3__img" src="' . $file . '" alt="">
                            </div>
                            <div class="m-widget3__info">
                                <span class="m-widget3__username">
                                    ' . $blog['title'] . '
                                </span><br>
                                <span class="m-widget3__time">
                                    ' . $blog['created_at']->diffForHumans() . '
                                </span>
                            </div>
                        </div>
                    </div>
                </div>';
                })
                ->editColumn('author', function ($agenda) {
                    if ($agenda['role'] == 'user') {
                        $user = User::find($agenda['id_user']);
                    } else {
                        $user = Admin::find($agenda['id_user']);
                    }
                    return $user['name'];
                })
                ->addColumn('date', function ($agenda) {
                    return DateHelper::getTanggal($agenda['created_at']);
                })
                ->editColumn('status', function ($agenda) {
                    return '<span class="m-badge m-badge--' . StatusHelper::agendas($agenda['status'])['class'] . ' m-badge--wide">' . StatusHelper::agendas($agenda['status'])['message'] . '</span>';
                })
                ->rawColumns(['action', 'title', 'author', 'date', 'status'])
                ->make(true);
        }
        return view('content.blogs.v_blog');
    }

    public function create()
    {
        session()->put('title', 'Tambah Blog Baru');
        $categories = CategoryOther::where([
            ['type', 'blog'],
            ['status', 1],
        ])->get();
        $action = 'create';
        return view('content.blogs.v_create_blog', compact('categories', 'action'));
    }

    public function edit($code)
    {
        // dd($code);
        $blog = Blog::where('code', $code)->first();
        $categories = CategoryOther::where([
            ['type', 'blog'],
            ['status', 1],
        ])->get();
        $action = 'edit';
        return view('content.blogs.v_create_blog', compact('categories', 'blog', 'action'));
    }

    public function store(Request $request)
    {
        $customAttributes = [
            'title' => 'Judul Blog'
        ];

        $max_size = 'max:' . env('CONFIG_MAX_UPLOAD');
        $mimes = 'mimes:' . str_replace('|', ',', env('CONFIG_FORMAT_IMAGE'));
        $rules = [
            'file' => ['image', $mimes, $max_size],
            'title' => ['required', "regex:/^[a-zA-Z .,']+$/"],
        ];

        $messages = [
            'required' => ':attribute harus diisi.',
            'mimes' => 'Format tipe gambar :attribute yang diupload tidak diperbolehkan',
            'max' => 'Ukuran maksimal file ' . env('CONFIG_MAX_UPLOAD') / 1000 . ' MB',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'status' => false,
            ], 302);
        } else {
            $data = $request->toArray();
            if (!empty($request->file)) {
                $data = ImageHelper::upload_asset($request, 'file', 'profile', $data);
            }
            $data['code'] = str_slug($data['title']) . '-' . Helper::str_random(5);
            $data['role'] = session('role');
            $data['id_user'] = session('id');
            Blog::updateOrCreate(
                ['id' => $request->id],
                $data
            );
            return response()->json([
                'message' => 'Blog berhasil disimpan',
                'status' => true,
            ], 200);
        }
    }

    public function detail($code)
    {
        $blog = Blog::where('code', $code)->first();
        if ($blog['role'] == 'user') {
            $user = User::find($blog['id_user']);
        } else {
            $user = Admin::find($blog['id_user']);
        }
        $blogs = Blog::where([
            ['role', $blog['role']],
            ['id_user', $blog['id_user']],
            ['status', '!=', 0],
        ])->get();
        return view('content.blogs.v_detail_blog', compact('blog', 'user', 'blogs'));
    }

    public function delete(Request $request)
    {
        $blog = Blog::find($request->id);
        $blog->update(array('status' => 0));
        return response()->json([
            'message' => 'Blog berhasil dihapus',
            'status' => true,
        ], 200);
    }
}
