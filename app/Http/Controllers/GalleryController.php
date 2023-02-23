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
        session()->put('title', 'Galleri');
        $galleries = Gallery::where('status', '!=', 0);
        if ($request->ajax()) {
            return DataTables::of($galleries)->addIndexColumn()
                ->editColumn('name', function ($row) {
                    $file = json_decode($row['file']);
                    $file = asset(reset($file));
                    // $file = $row['file'] ? asset($row['file']) : asset('asset/img/user4.jpg');
                    return '<div class="m-widget3">
                    <div class="m-widget3__item mb-0">
                        <div class="m-widget3__header">
                            <a href="javascript:void(0)" class="load_image" onclick="loadImage(' . $row['id'] . ')">
                                <div class="m-widget3__user-img mb-0">
                                    <img class="m-widget3__img rounded" src="' . $file . '" alt="">
                                </div>
                            </a>
                            <div class="m-widget3__info">
                                <span class="m-widget3__username">
                                    ' . $row['name'] . '
                                </span><br>
                                <span class="m-widget3__time">
                                    ' . $row['description'] . '
                                </span>
                            </div>
                        </div>
                        
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
                ->editColumn('publish', function ($gallery) {
                    $checked = '';
                    if ($gallery['publish'] == 1) {
                        $checked = 'checked';
                    }
                    $btn = '<span class="m-switch m-switch--sm m-switch--icon">
                        <label class="mb-0">
                            <input type="checkbox" ' . $checked . ' class="update_publish" data-id="' . $gallery['id'] . '">
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
                ->rawColumns(['status', 'name', 'check', 'author', 'date', 'publish'])
                ->make(true);
        }
        return view('content.galleries.v_gallery');
    }

    // public function more(Request $request, $code)
    // {
    //     // dd($code);
    //     session()->put('title', 'Galeri');
    //     $category = CategoryOther::where('code', $code)->first();

    // }

    public function store(Request $request)
    {
        // dd($request);
        $customAttributes = [
            'name' => 'Nama Galleri',
        ];

        // $max_size = 'max:' . env('CONFIG_MAX_UPLOAD');
        // $mimes = 'mimes:' . str_replace('|', ',', env('CONFIG_FORMAT_IMAGE'));
        $rules = [
            // 'file' => ['image', $mimes, $max_size],
            'name' => ['required'],
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

    public function load_image(Request $request)
    {
        $gallery = Gallery::find($request['id']);
        $image = json_decode($gallery['file']);
        $modal = '';
        foreach ($image as $img) {
            $modal .= '<div><img src="' . asset($img) . '" alt="" class="w-100"></div>';
        }
        $result = [
            'gallery' => $gallery['name'],
            'source_html' => $modal,
        ];
        // dd($modal);
        return $result;
    }

    public function download($code)
    {
        $image = Gallery::where('code', $code)->first();
        return ImageHelper::show_drive($image['file']);
    }
}
