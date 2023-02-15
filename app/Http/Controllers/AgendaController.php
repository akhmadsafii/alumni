<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Helpers\Helper;
use App\Helpers\ImageHelper;
use App\Helpers\StatusHelper;
use App\Models\Admin;
use App\Models\Agenda;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        session()->put('title', 'Agenda');
        $agendas = Agenda::where('status', '!=', 0)->get();
        if ($request->ajax()) {
            return DataTables::of($agendas)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<span class="dropdown">
                        <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                            <i class="la la-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="javascript:void(0)" onclick="detailData(' . $row['id'] . ')"><i class="la la-info-circle"></i> Detail</a>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="editData(' . $row['id'] . ')"><i class="la la-edit"></i> Edit</a>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="deleteData(' . $row['id'] . ')"><i class="la la-trash"></i> Hapus</a>
                        </div>
                    </span>';
                    return $btn;
                })
                ->editColumn('title', function ($agenda) {
                    $file = $agenda['file'] ? asset($agenda['file']) : asset('asset/img/user4.jpg');
                    return '<div class="m-widget3">
                    <div class="m-widget3__item mb-0">
                        <div class="m-widget3__header">
                            <div class="m-widget3__user-img mb-0">
                                <img class="m-widget3__img rounded" src="' . $file . '" alt="">
                            </div>
                            <div class="m-widget3__info">
                                <span class="m-widget3__username">
                                    ' . $agenda['title'] . '
                                </span><br>
                                <span class="m-widget3__time">
                                    ' . $agenda['created_at']->diffForHumans() . '
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
                ->addColumn('time', function ($agenda) {
                    return DateHelper::getDayMonth($agenda['start_date']) . ' - ' . DateHelper::getTanggal($agenda['end_date']) . '<br> Waktu ' . DateHelper::getTime($agenda['start_date']);
                })
                ->editColumn('status', function ($agenda) {
                    return '<span class="m-badge m-badge--' . StatusHelper::agendas($agenda['status'])['class'] . ' m-badge--wide">' . StatusHelper::agendas($agenda['status'])['message'] . '</span>';
                })
                ->rawColumns(['action', 'title', 'author', 'time', 'status'])
                ->make(true);
        }
        return view('content.agendas.v_agenda');
    }

    public function store(Request $request)
    {
        // dd($request);
        $customAttributes = [
            'title' => 'Judul Agenda',
        ];

        $max_size = 'max:' . env('CONFIG_MAX_UPLOAD');
        $mimes = 'mimes:' . str_replace('|', ',', env('CONFIG_FORMAT_IMAGE'));
        $rules = [
            'file' => ['image', $mimes, $max_size],
            'title' => ['required', "regex:/^[a-zA-Z .,']+$/"],
            // 'username' => ['required', "regex:/^[a-zA-Z .,']+$/"],
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
            Agenda::updateOrCreate(
                ['id' => $request->id],
                $data
            );
            return response()->json([
                'message' => 'Agenda berhasil disimpan',
                'status' => true,
            ], 200);
        }
    }

    public function detail(Request $request)
    {
        // dd($request);
        $agenda = Agenda::find($request['id']);
        return response()->json($agenda);
    }
}
