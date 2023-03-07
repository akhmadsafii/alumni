<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Major;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MajorController extends Controller
{
    public function index(Request $request)
    {
        session()->put('title', 'Jurusan');
        $majors = Major::where('status', '!=', 0);
        if ($request->ajax()) {
            return DataTables::of($majors)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<span class="dropdown">
                        <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                            <i class="la la-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="javascript:void(0)" onclick="editData(' . $row['id'] . ')"><i class="la la-edit"></i> Edit</a>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="deleteData(' . $row['id'] . ')"><i class="la la-trash"></i> Hapus</a>
                        </div>
                    </span>';
                    return $btn;
                })
                ->addColumn('check', function ($category) {
                    $btn = '<div class="m-checkbox-list">
                    <label class="m-checkbox">
                        <input type="checkbox" name="category[]" value="' . $category['id'] . '"
                            class="check_category">&nbsp;
                        <span></span>
                    </label>
                </div>';
                    return $btn;
                })
                ->editColumn('status', function ($category) {
                    $checked = '';
                    if ($category['status'] == 1) {
                        $checked = 'checked';
                    }
                    $btn = '<span class="m-switch m-switch--sm m-switch--icon">
                        <label class="mb-0">
                            <input type="checkbox" ' . $checked . ' class="update_status" data-id="' . $category['id'] . '">
                            <span></span>
                        </label>
                    </span>
                    ';
                    return $btn;
                })
                ->rawColumns(['action', 'check', 'status'])
                ->make(true);
        }
        // dd($admin);
        return view('content.majors.v_major');
    }

    public function store(Request $request)
    {
        $data = $request->toArray();
        $data['code'] = str_slug($data['name']) . '-' . Helper::str_random(5);
        Major::updateOrCreate(
            ['id' => $request->id],
            $data
        );
        return response()->json([
            'message' => 'Jurusan berhasil disimpan',
            'status' => true,
        ], 200);
    }

    public function update_status(Request $request)
    {
        Major::where('id', $request->id)->update(['status' => $request->status]);
        return response()->json([
            'message' => 'Jurusan berhasil diperbarui',
            'status' => true,
        ], 200);
    }

    public function detail(Request $request)
    {
        $category = Major::find($request->id);
        return response()->json($category);
    }

    public function delete(Request $request)
    {
        $category = Major::find($request->id);
        $category->update(array('status' => 0));
        return response()->json([
            'message' => 'Jurusan berhasil dihapus',
            'status' => true,
        ], 200);
    }
}
