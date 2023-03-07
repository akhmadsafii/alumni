<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Helpers\Helper;
use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Major;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        session()->put('title', 'Alumni');
        $majors = Major::where('status', 1)->get();
        // dd($majors);
        $list_user = User::latest()->where('status','!=', 0)->get();
        $users = UserResource::collection($list_user)->resolve();
        // dd($users);
        if ($request->ajax()) {
            return DataTables::of($users)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<span class="dropdown">
                        <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                            <i class="la la-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="javascript:void(0)" onclick="editData(' . $row['id'] . ')"><i class="la la-edit"></i> Edit Detail</a>
                            <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="deleteData(' . $row['id'] . ')"><i class="la la-trash"></i> Hapus</a>
                        </div>
                    </span>';
                    return $btn;
                })
                ->addColumn('name', function ($user) {
                    return '<div class="m-list-search">
                    <div class="m-list-search__results">
                        <a href="#" class="m-list-search__result-item">
                            <span class="m-list-search__result-item-pic"><img class="rounded" src="'.$user['file'].'" title=""></span>
                            <span class="m-list-search__result-item-text">'.$user['name'].'</span>
                        </a>

                    </div>
                </div>';
                })
                ->rawColumns(['action', 'name'])
                ->make(true);
        }
        // dd($user);
        return view('content.users.v_user', compact('majors'));
    }

    public function detail(Request $request)
    {
        $user = User::find($request->id);
        $user['avatar'] = $user['file'] ? asset($user['file']) : 'https://via.placeholder.com/150';
        return response()->json($user);
    }

    public function store(Request $request)
    {
        // dd($request);
        $customAttributes = [
            'name' => 'Nama User',
            'phone' => 'Telepon User',
        ];

        $max_size = 'max:' . env('CONFIG_MAX_UPLOAD');
        $mimes = 'mimes:' . str_replace('|', ',', env('CONFIG_FORMAT_IMAGE'));
        $rules = [
            'file' => ['image', $mimes, $max_size],
            'name' => ['required'],
            // 'username' => ['required', "regex:/^[a-zA-Z .,']+$/"],
        ];

        $messages = [
            'email' => ':attribute tidak valid.',
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
            $data['code'] = str_slug($data['name']) . '-' . Helper::str_random(5);
            if (!empty($request->file)) {
                $data = ImageHelper::upload_asset($request, 'file', 'profile', $data);
            }
            User::updateOrCreate(
                ['id' => $request->id],
                $data
            );
            return response()->json([
                'message' => 'User berhasil disimpan',
                'status' => true,
            ], 200);
        }
    }

    public function delete(Request $request)
    {
        $user = User::find($request->id);
        $user->update(array('status' => 0));
        return response()->json([
            'message' => 'Admin berhasil dihapus',
            'status' => true,
        ], 200);
    }
}
