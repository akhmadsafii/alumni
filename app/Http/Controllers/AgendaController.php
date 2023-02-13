<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
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
                            <a class="dropdown-item" href="javascript:void(0)" onclick="editData(' . $row['id'] . ')"><i class="la la-edit"></i> Edit Detail</a>
                            <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="deleteData(' . $row['id'] . ')"><i class="la la-trash"></i> Hapus</a>
                        </div>
                    </span>';
                    return $btn;
                })
                ->editColumn('last_login', function ($admin) {
                    return DateHelper::getHoursMinute($admin['last_login']);
                })
                ->rawColumns(['action', 'last_login'])
                ->make(true);
        }
        return view('content.agendas.v_agenda');
    }

    public function store(Request $request)
    {
        dd($request);
    }
}
