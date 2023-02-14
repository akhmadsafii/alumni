<?php

namespace App\Http\Controllers;

use App\Helpers\StatusHelper;
use App\Models\CategoryOther;
use App\Models\Gallery;
use Illuminate\Http\Request;
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
                ['id_category_other', $ls],
                ['status', '!=', 0]
            ])->count();
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
        return view('content.galleries.v_gallery', compact('category'));
    }
}
