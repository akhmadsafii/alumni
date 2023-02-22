<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Helpers\Helper;
use App\Helpers\ImageHelper;
use App\Helpers\StatusHelper;
use App\Models\Admin;
use App\Models\CategoryOther;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        // dd('galleri');
        session()->put('title', 'Kategori Galleri');
        $list = CategoryOther::where([
            ['type', 'gallery'],
            ['status', '!=', 0],
        ])->get();
        $categories = [];
        foreach ($list as $ls) {
            $total = Gallery::where([
                ['id_category_other', $ls['id']],
                ['status', '!=', 0]
            ])->get()->count();
            $categories[] = [
                'id' => $ls['id'],
                'name' => $ls['name'],
                'code' => $ls['code'],
                'status' => $ls['status'],
                'total' => $total
            ];
        }
        if ($request->ajax()) {
            return DataTables::of($categories)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<span class="dropdown">
                        <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                            <i class="la la-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="' . route('admin.gallery.more', $row['code']) . '"><i class="la la-info-circle"></i> Detail</a>
                            <a class="dropdown-item" href="' . route('admin.blog.edit', $row['code']) . '"><i class="la la-pencil"></i> Ubah</a>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="deleteData(' . $row['id'] . ')"><i class="la la-trash"></i> Hapus</a>
                        </div>
                    </span>';
                    return $btn;
                })
                ->editColumn('status', function ($gallery) {
                    return '<span class="m-badge m-badge--' . StatusHelper::status($gallery['status'])['class'] . ' m-badge--wide">' . StatusHelper::status($gallery['status'])['message'] . '</span>';
                })
                ->addColumn('check', function ($gallery) {
                    return '<div class="m-checkbox-list">
                    <label class="m-checkbox">
                        <input type="checkbox" value="" id="select_all">&nbsp;
                        <span></span>
                    </label>
                </div>';
                })
                ->rawColumns(['action', 'name', 'status', 'check'])
                ->make(true);
        }
        return view('content.galleries.v_category');
    }

    public function more(Request $request, $code)
    {
        // dd($code);
        session()->put('title', 'Galeri');
        $category = CategoryOther::where('code', $code)->first();
        $galleries = Gallery::where([
            ['id_category_other', $category['id']],
            ['status', '!=', 0]
        ]);
        if ($request->ajax()) {
            return DataTables::of($galleries)->addIndexColumn()
                ->editColumn('name', function ($row) {
                    $file = $row['file'] ? asset($row['file']) : asset('asset/img/user4.jpg');
                    return '<div class="m-widget3">
                    <div class="m-widget3__item mb-0">
                    <a href="' . route('admin.gallery.download', $row['code']) . '" target="_blank">
                        <div class="m-widget3__header">
                            <div class="m-widget3__user-img mb-0">
                                <img class="m-widget3__img rounded" src="' . $file . '" alt="">
                            </div>
                            <div class="m-widget3__info">
                                <span class="m-widget3__username">
                                    ' . $row['name'] . '
                                </span><br>
                                <span class="m-widget3__time">
                                    ' . $row['description'] . '
                                </span>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>';
                })
                ->editColumn('status', function ($gallery) {
                    $checked = '';
                    if ($gallery['status'] == 1) {
                        $checked = 'checked';
                    }
                    $btn = '<span class="m-switch m-switch--sm m-switch--icon">
                        <label class="mb-0">
                            <input type="checkbox" ' . $checked . ' class="update_status" data-id="' . $gallery['id'] . '">
                            <span></span>
                        </label>
                    </span>
                    ';
                    return $btn;
                })
                ->addColumn('author', function ($gallery) {
                    if ($gallery['role'] == 'user') {
                        $user = User::find($gallery['id_user']);
                    } else {
                        $user = Admin::find($gallery['id_user']);
                    }
                    return $user['name'];
                })
                ->addColumn('date', function ($gallery) {
                    return DateHelper::getTanggal($gallery['created_at']);
                })
                ->addColumn('check', function ($gallery) {
                    return '<div class="m-checkbox-list">
                    <label class="m-checkbox">
                        <input type="checkbox" value="" id="select_all">&nbsp;
                        <span></span>
                    </label>
                </div>';
                })
                ->rawColumns(['status', 'name', 'check', 'author', 'date'])
                ->make(true);
        }
        return view('content.galleries.v_gallery', compact('category'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $customAttributes = [
            'name' => 'Nama Admin',
        ];

        // $max_size = 'max:' . env('CONFIG_MAX_UPLOAD');
        // $mimes = 'mimes:' . str_replace('|', ',', env('CONFIG_FORMAT_IMAGE'));
        $rules = [
            // 'file' => ['image', $mimes, $max_size],
            'name' => ['required', "regex:/^[a-zA-Z .,']+$/"],
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
            $multiple_image = [];
            if ($request->hasFile('file')) {
                foreach ($request->file as $key => $photo) {
                    $path = ImageHelper::upload_multiple_asset_drive($photo, 'product');
                    array_push($multiple_image, $path);
                }
                $data['file'] = json_encode($multiple_image);
            }
            $data['id_user'] = session('id');
            $data['role'] = session('role');
            $data['code'] = str_slug($data['name']) . '-' . Helper::str_random(5);
            // dd($data);
            Gallery::updateOrCreate(
                ['id' => $request->id],
                $data
            );
            return response()->json([
                'message' => 'Galleri berhasil disimpan',
                'status' => true,
            ], 200);
        }
    }

    public function download($code)
    {
        $image = Gallery::where('code', $code)->first();
        return ImageHelper::show_drive($image['file']);
    }
}
